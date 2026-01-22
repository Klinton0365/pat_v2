@extends('user.layout.app')
@section('content')
    <!-- Spinner Start -->
    <div id="spinner"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->


    <!-- Single Page Header start -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6 wow fadeInUp" data-wow-delay="0.1s">Shop Page</h1>
        <ol class="breadcrumb justify-content-center mb-0 wow fadeInUp" data-wow-delay="0.3s">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Pages</a></li>
            <li class="breadcrumb-item active text-white">Shop</li>
        </ol>
    </div>
    <!-- Single Page Header End -->
    <style>
        canvas {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
        }

        .hero {
            position: relative;
            /* width: 100vw; */
            min-height: 100vh;
            display: flex;
            align-items: center;
            overflow: hidden;
            z-index: 5;
        }

        .hero__content {
            position: relative;
            z-index: 10;
            padding: 2vw 5vw;
            /* max-width: 1400px; */
            margin: 0 auto;
            width: 100%;
        }

        .hero__pretitle {
            font-size: clamp(0.9rem, 1.2vw, 1.2rem);
            font-weight: 500;
            color: rgba(255, 240, 179, 0.8);
            letter-spacing: 0.2em;
            text-transform: uppercase;
            margin-bottom: 1.5rem;
            filter: url(#water-distortion);
            will-change: filter;
            animation: fadeInUp 1s ease-out 0.3s both;
        }

        .hero__title {
            font-size: clamp(3.5rem, 12vw, 10rem);
            font-weight: 900;
            color: #fff0b3;
            line-height: 0.95;
            letter-spacing: -0.03em;
            text-shadow: 0 0 30px rgba(255, 240, 179, 0.4);
            filter: url(#water-distortion);
            will-change: filter;
            margin-bottom: 2rem;
            animation: fadeInUp 1s ease-out 0.5s both;
        }

        .hero__title span {
            display: block;
            background: linear-gradient(135deg, #fff0b3 0%, #a8d8ff 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero__subtitle {
            font-size: clamp(1.2rem, 2.5vw, 2.2rem);
            font-weight: 300;
            color: rgba(255, 255, 255, 0.85);
            line-height: 1.4;
            max-width: 800px;
            margin-bottom: 3rem;
            filter: url(#water-distortion);
            will-change: filter;
            animation: fadeInUp 1s ease-out 0.7s both;
        }

        .hero__cta {
            display: flex;
            gap: 1.5rem;
            flex-wrap: wrap;
            animation: fadeInUp 1s ease-out 0.9s both;
        }

        .cta-button {
            padding: 1.2rem 3rem;
            font-size: 1.1rem;
            font-weight: 600;
            text-decoration: none;
            border-radius: 50px;
            transition: all 0.3s ease;
            cursor: pointer;
            border: none;
            font-family: inherit;
            position: relative;
            overflow: hidden;
        }

        .cta-button::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }

        .cta-button:hover::before {
            width: 300px;
            height: 300px;
        }

        .cta-button span {
            position: relative;
            z-index: 1;
        }

        .cta-button--primary {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            color: #000;
            box-shadow: 0 10px 40px rgba(79, 172, 254, 0.4);
        }

        .cta-button--primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 50px rgba(79, 172, 254, 0.6);
        }

        .cta-button--secondary {
            background: transparent;
            color: #fff;
            border: 2px solid rgba(255, 255, 255, 0.3);
        }

        .cta-button--secondary:hover {
            border-color: rgba(255, 255, 255, 0.8);
            transform: translateY(-3px);
        }

        .hero__features {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 2rem;
            margin-top: 5rem;
            animation: fadeInUp 1s ease-out 1.1s both;
        }

        .feature {
            text-align: center;
            padding: 1.5rem;
            background: rgba(255, 255, 255, 0.03);
            border-radius: 15px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
        }

        .feature:hover {
            background: rgba(255, 255, 255, 0.06);
            border-color: rgba(79, 172, 254, 0.3);
            transform: translateY(-5px);
        }

        .feature__icon {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            filter: drop-shadow(0 0 10px rgba(79, 172, 254, 0.5));
        }

        .feature__title {
            font-size: 1.1rem;
            font-weight: 600;
            color: #fff0b3;
            margin-bottom: 0.5rem;
        }

        .feature__text {
            font-size: 0.9rem;
            color: rgba(255, 255, 255, 0.7);
            line-height: 1.5;
        }

        #svg-filters {
            position: absolute;
            width: 0;
            height: 0;
            pointer-events: none;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 768px) {
            .hero__content {
                padding: 8vh 6vw;
            }

            .hero__pretitle {
                font-size: 0.8rem;
                margin-bottom: 1rem;
            }

            .hero__title {
                font-size: clamp(2.5rem, 10vw, 5rem);
                margin-bottom: 1.5rem;
            }

            .hero__subtitle {
                font-size: clamp(1rem, 4vw, 1.5rem);
                margin-bottom: 2rem;
            }

            .hero__cta {
                flex-direction: column;
                gap: 1rem;
            }

            .cta-button {
                width: 100%;
                text-align: center;
                padding: 1rem 2rem;
            }

            .hero__features {
                grid-template-columns: 1fr;
                gap: 1.5rem;
                margin-top: 3rem;
            }
        }
    </style>
    <svg id="svg-filters">
        <defs>
            <filter id="water-distortion" x="-20%" y="-20%" width="140%" height="140%">
                <feTurbulence id="turbulence" baseFrequency="0.015 0.01" numOctaves="2" result="noise" />
                <feDisplacementMap in="SourceGraphic" in2="noise" scale="8" />
            </filter>
        </defs>
    </svg>
    <script type="module">
        import * as THREE from "https://esm.sh/three@0.175.0";

        class App {
            constructor() {
                this.settings = {
                    damping: 0.98,
                    tension: 0.02,
                    resolution: 512,
                    rippleStrength: 1.0,
                    mouseIntensity: 0.3,
                    clickIntensity: 2.0,
                    rippleRadius: 20,
                    autoDrops: true,
                    autoDropInterval: 3000,
                    autoDropIntensity: 1.0,
                    performanceMode: true
                };

                this.gradientColors = {
                    colorA1: [0.2, 0.5, 0.8],
                    colorA2: [0.1, 0.3, 0.6],
                    colorB1: [0.3, 0.7, 0.9],
                    colorB2: [0.2, 0.4, 0.7]
                };

                this.lastMousePosition = { x: 0, y: 0 };
                this.mouseThrottleTime = 0;

                this.init();
            }

            init() {
                this.renderer = new THREE.WebGLRenderer({
                    antialias: true,
                    powerPreference: "high-performance"
                });
                this.renderer.setSize(window.innerWidth, window.innerHeight);
                this.renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
                document.body.appendChild(this.renderer.domElement);

                this.scene = new THREE.Scene();
                this.camera = new THREE.OrthographicCamera(
                    -window.innerWidth / 2,
                    window.innerWidth / 2,
                    window.innerHeight / 2,
                    -window.innerHeight / 2,
                    0.1,
                    1000
                );
                this.camera.position.z = 10;

                this.clock = new THREE.Clock();

                this.initWaterRipple();
                this.createBackground();
                this.bindEvents();
                this.setupAutoDrops();

                setTimeout(() => {
                    const centerX = window.innerWidth / 2;
                    const centerY = window.innerHeight / 2;
                    this.addRipple(centerX, centerY, 1.5);
                }, 500);

                this.tick();
            }

            initWaterRipple() {
                const resolution = this.settings.resolution;

                this.waterBuffers = {
                    current: new Float32Array(resolution * resolution),
                    previous: new Float32Array(resolution * resolution)
                };

                this.waterTexture = new THREE.DataTexture(
                    this.waterBuffers.current,
                    resolution,
                    resolution,
                    THREE.RedFormat,
                    THREE.FloatType
                );
                this.waterTexture.minFilter = THREE.LinearFilter;
                this.waterTexture.magFilter = THREE.LinearFilter;
                this.waterTexture.needsUpdate = true;
            }

            createBackground() {
                const backgroundShader = {
                    uniforms: {
                        waterTexture: { value: this.waterTexture },
                        rippleStrength: { value: this.settings.rippleStrength },
                        resolution: {
                            value: new THREE.Vector2(window.innerWidth, window.innerHeight)
                        },
                        time: { value: 0 },
                        colorA1: {
                            value: new THREE.Vector3(
                                this.gradientColors.colorA1[0],
                                this.gradientColors.colorA1[1],
                                this.gradientColors.colorA1[2]
                            )
                        },
                        colorA2: {
                            value: new THREE.Vector3(
                                this.gradientColors.colorA2[0],
                                this.gradientColors.colorA2[1],
                                this.gradientColors.colorA2[2]
                            )
                        },
                        colorB1: {
                            value: new THREE.Vector3(
                                this.gradientColors.colorB1[0],
                                this.gradientColors.colorB1[1],
                                this.gradientColors.colorB1[2]
                            )
                        },
                        colorB2: {
                            value: new THREE.Vector3(
                                this.gradientColors.colorB2[0],
                                this.gradientColors.colorB2[1],
                                this.gradientColors.colorB2[2]
                            )
                        }
                    },
                    vertexShader: `
                                                                                            varying vec2 vUv;

                                                                                            void main() {
                                                                                                vUv = uv;
                                                                                                gl_Position = projectionMatrix * modelViewMatrix * vec4(position, 1.0);
                                                                                            }
                                                                                        `,
                    fragmentShader: `
                                                                                            uniform sampler2D waterTexture;
                                                                                            uniform float rippleStrength;
                                                                                            uniform vec2 resolution;
                                                                                            uniform float time;
                                                                                            uniform vec3 colorA1;
                                                                                            uniform vec3 colorA2;
                                                                                            uniform vec3 colorB1;
                                                                                            uniform vec3 colorB2;
                                                                                            varying vec2 vUv;

                                                                                            float S(float a, float b, float t) {
                                                                                                return smoothstep(a, b, t);
                                                                                            }

                                                                                            mat2 Rot(float a) {
                                                                                                float s = sin(a);
                                                                                                float c = cos(a);
                                                                                                return mat2(c, -s, s, c);
                                                                                            }

                                                                                            float noise(vec2 p) {
                                                                                                vec2 ip = floor(p);
                                                                                                vec2 fp = fract(p);
                                                                                                float a = fract(sin(dot(ip, vec2(12.9898, 78.233))) * 43758.5453);
                                                                                                float b = fract(sin(dot(ip + vec2(1.0, 0.0), vec2(12.9898, 78.233))) * 43758.5453);
                                                                                                float c = fract(sin(dot(ip + vec2(0.0, 1.0), vec2(12.9898, 78.233))) * 43758.5453);
                                                                                                float d = fract(sin(dot(ip + vec2(1.0, 1.0), vec2(12.9898, 78.233))) * 43758.5453);

                                                                                                fp = fp * fp * (3.0 - 2.0 * fp);

                                                                                                return mix(mix(a, b, fp.x), mix(c, d, fp.x), fp.y);
                                                                                            }

                                                                                            void main() {
                                                                                                float waterHeight = texture2D(waterTexture, vUv).r;

                                                                                                float step = 1.0 / resolution.x;
                                                                                                vec2 distortion = vec2(
                                                                                                    texture2D(waterTexture, vec2(vUv.x + step, vUv.y)).r - texture2D(waterTexture, vec2(vUv.x - step, vUv.y)).r,
                                                                                                    texture2D(waterTexture, vec2(vUv.x, vUv.y + step)).r - texture2D(waterTexture, vec2(vUv.x, vUv.y - step)).r
                                                                                                ) * rippleStrength * 5.0;

                                                                                                vec2 tuv = vUv + distortion;
                                                                                                tuv -= 0.5;

                                                                                                float ratio = resolution.x / resolution.y;
                                                                                                tuv.y *= 1.0/ratio;

                                                                                                vec3 layer1 = mix(colorA1, colorA2, S(-0.3, 0.2, (tuv*Rot(radians(-5.0))).x));
                                                                                                vec3 layer2 = mix(colorB1, colorB2, S(-0.3, 0.2, (tuv*Rot(radians(-5.0))).x));
                                                                                                vec3 finalComp = mix(layer1, layer2, S(0.5, -0.3, tuv.y));

                                                                                                float noiseValue = noise(tuv * 20.0 + time * 0.1) * 0.03;
                                                                                                finalComp += vec3(noiseValue);

                                                                                                float vignette = 1.0 - smoothstep(0.5, 1.5, length(tuv * 1.5));
                                                                                                finalComp *= mix(0.95, 1.0, vignette);

                                                                                                gl_FragColor = vec4(finalComp, 1.0);
                                                                                            }
                                                                                        `
                };

                const geometry = new THREE.PlaneGeometry(
                    window.innerWidth,
                    window.innerHeight
                );
                this.backgroundMaterial = new THREE.ShaderMaterial({
                    uniforms: backgroundShader.uniforms,
                    vertexShader: backgroundShader.vertexShader,
                    fragmentShader: backgroundShader.fragmentShader
                });

                const mesh = new THREE.Mesh(geometry, this.backgroundMaterial);
                this.scene.add(mesh);
            }

            updateWaterSimulation() {
                const { current, previous } = this.waterBuffers;
                const { damping, tension, resolution } = this.settings;

                const safeTension = Math.min(tension, 0.05);

                for (let i = 1; i < resolution - 1; i++) {
                    for (let j = 1; j < resolution - 1; j++) {
                        const index = i * resolution + j;

                        const top = previous[index - resolution];
                        const bottom = previous[index + resolution];
                        const left = previous[index - 1];
                        const right = previous[index + 1];

                        current[index] = (top + bottom + left + right) / 2 - current[index];
                        current[index] =
                            current[index] * damping + previous[index] * (1 - damping);
                        current[index] += (0 - previous[index]) * safeTension;
                        current[index] = Math.max(-1.0, Math.min(1.0, current[index]));
                    }
                }

                [this.waterBuffers.current, this.waterBuffers.previous] = [
                    this.waterBuffers.previous,
                    this.waterBuffers.current
                ];

                this.waterTexture.image.data = this.waterBuffers.current;
                this.waterTexture.needsUpdate = true;
            }

            addRipple(x, y, strength = 1.0) {
                const { resolution, rippleRadius } = this.settings;

                const normalizedX = x / window.innerWidth;
                const normalizedY = 1.0 - y / window.innerHeight;

                const texX = Math.floor(normalizedX * resolution);
                const texY = Math.floor(normalizedY * resolution);

                const radius = rippleRadius;
                const rippleStrength = strength;
                const radiusSquared = radius * radius;

                for (let i = -radius; i <= radius; i++) {
                    for (let j = -radius; j <= radius; j++) {
                        const distanceSquared = i * i + j * j;

                        if (distanceSquared <= radiusSquared) {
                            const posX = texX + i;
                            const posY = texY + j;

                            if (
                                posX >= 0 &&
                                posX < resolution &&
                                posY >= 0 &&
                                posY < resolution
                            ) {
                                const index = posY * resolution + posX;
                                const distance = Math.sqrt(distanceSquared);
                                const rippleValue =
                                    Math.cos(((distance / radius) * Math.PI) / 2) * rippleStrength;
                                this.waterBuffers.previous[index] += rippleValue;
                            }
                        }
                    }
                }
            }

            bindEvents() {
                window.addEventListener("mousemove", (ev) => {
                    const rect = this.renderer.domElement.getBoundingClientRect();
                    const x = ev.clientX - rect.left;
                    const y = ev.clientY - rect.top;

                    const now = performance.now();
                    if (now - this.mouseThrottleTime < 16) return;
                    this.mouseThrottleTime = now;

                    const dx = x - this.lastMousePosition.x;
                    const dy = y - this.lastMousePosition.y;
                    const distSquared = dx * dx + dy * dy;

                    if (distSquared > 5) {
                        this.addRipple(x, y, this.settings.mouseIntensity);
                        this.lastMousePosition.x = x;
                        this.lastMousePosition.y = y;
                    }
                });

                window.addEventListener("click", (e) => {
                    const rect = this.renderer.domElement.getBoundingClientRect();
                    const x = e.clientX - rect.left;
                    const y = e.clientY - rect.top;
                    this.addRipple(x, y, this.settings.clickIntensity);
                });

                window.addEventListener("resize", () => {
                    const width = window.innerWidth;
                    const height = window.innerHeight;

                    this.camera.left = -width / 2;
                    this.camera.right = width / 2;
                    this.camera.top = height / 2;
                    this.camera.bottom = -height / 2;
                    this.camera.updateProjectionMatrix();

                    this.renderer.setSize(width, height);

                    if (this.backgroundMaterial) {
                        this.backgroundMaterial.uniforms.resolution.value.set(width, height);
                    }

                    if (this.scene.children[0] && this.scene.children[0].geometry) {
                        this.scene.children[0].geometry.dispose();
                        this.scene.children[0].geometry = new THREE.PlaneGeometry(
                            width,
                            height
                        );
                    }
                });
            }

            setupAutoDrops() {
                if (this.autoDropsInterval) {
                    clearInterval(this.autoDropsInterval);
                }

                if (this.settings.autoDrops) {
                    this.autoDropsInterval = setInterval(() => {
                        if (!this.settings.autoDrops) return;

                        const x = Math.random() * window.innerWidth;
                        const y = Math.random() * window.innerHeight;
                        this.addRipple(x, y, this.settings.autoDropIntensity);
                    }, this.settings.autoDropInterval);
                }
            }

            updateTextDistortion() {
                const turbulence = document.getElementById("turbulence");
                if (turbulence) {
                    const time = this.clock.getElapsedTime();
                    const frequency1 = 0.015 + Math.sin(time * 0.5) * 0.005;
                    const frequency2 = 0.01 + Math.cos(time * 0.3) * 0.003;
                    turbulence.setAttribute("baseFrequency", `${frequency1} ${frequency2}`);
                }
            }

            tick() {
                this.updateWaterSimulation();
                this.updateTextDistortion();

                if (this.backgroundMaterial) {
                    this.backgroundMaterial.uniforms.rippleStrength.value = this.settings.rippleStrength;
                    this.backgroundMaterial.uniforms.time.value += this.clock.getDelta();
                }

                this.renderer.render(this.scene, this.camera);
                requestAnimationFrame(() => this.tick());
            }
        }

        window.addEventListener("DOMContentLoaded", () => {
            new App();
        });
    </script>

    <!-- Searvices Start -->
    <style>
        .feature-item {
            background: rgba(255, 255, 255, 0.05);
            border-right: 1px solid rgba(255, 255, 255, 0.1) !important;
            border-left: 1px solid rgba(255, 255, 255, 0.1) !important;
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
        }

        .feature-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(79, 172, 254, 0.1), transparent);
            transition: left 0.6s ease;
        }

        .feature-item:hover::before {
            left: 100%;
        }

        .feature-content {
            padding: 2rem 1.5rem;
        }

        .feature-icon-wrapper {
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(79, 172, 254, 0.15);
            border-radius: 12px;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
        }

        .feature-item:hover .feature-icon-wrapper {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            transform: scale(1.1) rotate(-5deg);
            box-shadow: 0 8px 25px rgba(79, 172, 254, 0.4);
        }

        .feature-icon-wrapper i {
            font-size: 1.8rem;
            color: rgba(255, 255, 255, 0.6);
            transition: all 0.4s ease;
        }

        .feature-item:hover .feature-icon-wrapper i {
            color: #000;
            transform: scale(1.05);
        }

        .feature-text h6 {
            color: #fff;
            font-weight: 600;
            font-size: 0.95rem;
            letter-spacing: 0.05em;
            margin-bottom: 0.5rem;
            transition: color 0.3s ease;
        }

        .feature-item:hover .feature-text h6 {
            color: #4facfe;
        }

        .feature-text p {
            color: rgba(255, 255, 255, 0.65);
            font-size: 0.875rem;
            line-height: 1.5;
            margin-bottom: 0;
        }

        @media (max-width: 991px) {
            .feature-item {
                border-bottom: 1px solid rgba(255, 255, 255, 0.1) !important;
            }
        }

        @media (max-width: 767px) {
            .feature-content {
                padding: 1.5rem 1rem;
            }

            .feature-icon-wrapper {
                width: 50px;
                height: 50px;
            }

            .feature-icon-wrapper i {
                font-size: 1.5rem;
            }

            .feature-text h6 {
                font-size: 0.85rem;
            }

            .feature-text p {
                font-size: 0.8rem;
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fadeInUp:nth-child(1) {
            animation-delay: 0.1s;
        }

        .fadeInUp:nth-child(2) {
            animation-delay: 0.2s;
        }

        .fadeInUp:nth-child(3) {
            animation-delay: 0.3s;
        }

        .fadeInUp:nth-child(4) {
            animation-delay: 0.4s;
        }

        .fadeInUp:nth-child(5) {
            animation-delay: 0.5s;
        }

        .fadeInUp:nth-child(6) {
            animation-delay: 0.6s;
        }
    </style>
    <div class="features-section">
        <div class="container-fluid px-0">
            <div class="row g-0">
                <div class="col-6 col-md-4 col-lg-2 feature-item fadeInUp">
                    <div class="feature-content">
                        <div class="d-flex align-items-center">
                            <div class="feature-icon-wrapper">
                                <i class="fas fa-shield-halved"></i>
                            </div>
                            <div class="feature-text ms-3">
                                <h6 class="text-uppercase mb-2">Quality Guarantee</h6>
                                <p class="mb-0">30 days satisfaction guarantee</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-6 col-md-4 col-lg-2 feature-item fadeInUp">
                    <div class="feature-content">
                        <div class="d-flex align-items-center">
                            <div class="feature-icon-wrapper">
                                <i class="fas fa-truck-fast"></i>
                            </div>
                            <div class="feature-text ms-3">
                                <h6 class="text-uppercase mb-2">Free Installation</h6>
                                <p class="mb-0">Professional setup included</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-6 col-md-4 col-lg-2 feature-item fadeInUp">
                    <div class="feature-content">
                        <div class="d-flex align-items-center">
                            <div class="feature-icon-wrapper">
                                <i class="fas fa-headset"></i>
                            </div>
                            <div class="feature-text ms-3">
                                <h6 class="text-uppercase mb-2">Support 24/7</h6>
                                <p class="mb-0">Round-the-clock assistance</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-6 col-md-4 col-lg-2 feature-item fadeInUp">
                    <div class="feature-content">
                        <div class="d-flex align-items-center">
                            <div class="feature-icon-wrapper">
                                <i class="fas fa-certificate"></i>
                            </div>
                            <div class="feature-text ms-3">
                                <h6 class="text-uppercase mb-2">Certified Products</h6>
                                <p class="mb-0">ISO & NSF certified systems</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-6 col-md-4 col-lg-2 feature-item fadeInUp">
                    <div class="feature-content">
                        <div class="d-flex align-items-center">
                            <div class="feature-icon-wrapper">
                                <i class="fas fa-droplet"></i>
                            </div>
                            <div class="feature-text ms-3">
                                <h6 class="text-uppercase mb-2">Pure Water Tech</h6>
                                <p class="mb-0">96.9% filtration efficiency</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-6 col-md-4 col-lg-2 feature-item fadeInUp">
                    <div class="feature-content">
                        <div class="d-flex align-items-center">
                            <div class="feature-icon-wrapper">
                                <i class="fas fa-wrench"></i>
                            </div>
                            <div class="feature-text ms-3">
                                <h6 class="text-uppercase mb-2">Free Maintenance</h6>
                                <p class="mb-0">Annual service included</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Searvices End -->


   {{-- 
    Professional Shop Page Design - Human Psychology Based UI/UX
    
    Color Psychology Applied:
    - Primary Blue (#1e40af): Trust, reliability, professionalism
    - Accent Blue (#3b82f6): Interactive elements, links
    - Success Green (#059669): Savings, positive actions
    - Warning Amber (#f59e0b): Attention, featured items
    - Danger Red (#dc2626): Urgency, discounts, sales
    - Neutral grays: Clean, professional feel
    
    UX Psychology Principles:
    - Visual hierarchy guides user to products
    - Scarcity indicators (discount badges, sale tags)
    - Social proof (ratings, reviews)
    - Clear CTAs with high contrast
    - Reduced cognitive load with clean layout
    - Familiarity patterns (standard e-commerce layout)
    - Progressive disclosure (filters, details)
--}}

<style>
    :root {
        --primary: #1e40af;
        --primary-light: #3b82f6;
        --primary-dark: #1e3a8a;
        --success: #059669;
        --success-light: #d1fae5;
        --warning: #f59e0b;
        --warning-light: #fef3c7;
        --danger: #dc2626;
        --danger-light: #fee2e2;
        --text-primary: #111827;
        --text-secondary: #4b5563;
        --text-muted: #9ca3af;
        --border: #e5e7eb;
        --bg-light: #f9fafb;
        --bg-card: #ffffff;
        --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
        --shadow: 0 1px 3px 0 rgb(0 0 0 / 0.1), 0 1px 2px -1px rgb(0 0 0 / 0.1);
        --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
        --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
        --radius: 12px;
        --radius-sm: 8px;
        --radius-lg: 16px;
    }

    /* ==================== OFFER BANNERS ==================== */
    .offer-section {
        background: var(--bg-light);
        padding: 3rem 0;
    }

    .offer-card {
        position: relative;
        border-radius: var(--radius-lg);
        overflow: hidden;
        background: var(--bg-card);
        box-shadow: var(--shadow-md);
        transition: all 0.3s ease;
        text-decoration: none;
        display: block;
        height: 100%;
    }

    .offer-card:hover {
        transform: translateY(-4px);
        box-shadow: var(--shadow-lg);
    }

    .offer-card-inner {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 2rem;
        min-height: 200px;
    }

    .offer-card-content {
        flex: 1;
        padding-right: 1rem;
    }

    .offer-card-subtitle {
        font-size: 0.875rem;
        color: var(--text-muted);
        margin-bottom: 0.5rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .offer-card-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 0.75rem;
    }

    .offer-card-discount {
        font-size: 2.5rem;
        font-weight: 800;
        margin-bottom: 0;
    }

    .offer-card-discount .number {
        color: var(--primary);
    }

    .offer-card-discount .text {
        font-size: 1.5rem;
        color: var(--text-secondary);
        font-weight: 500;
    }

    .offer-card-image {
        width: 180px;
        height: 180px;
        object-fit: contain;
        transition: transform 0.3s ease;
    }

    .offer-card:hover .offer-card-image {
        transform: scale(1.05);
    }

    /* Offer card variants */
    .offer-card.primary {
        background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
        border: 1px solid #bfdbfe;
    }

    .offer-card.warning {
        background: linear-gradient(135deg, #fffbeb 0%, #fef3c7 100%);
        border: 1px solid #fde68a;
    }

    .offer-card.warning .offer-card-discount .number {
        color: var(--warning);
    }

    /* ==================== SHOP SECTION ==================== */
    .shop-section {
        background: var(--bg-card);
        padding: 3rem 0;
    }

    /* ==================== SIDEBAR ==================== */
    .shop-sidebar {
        position: sticky;
        top: 1rem;
    }

    .sidebar-card {
        background: var(--bg-card);
        border: 1px solid var(--border);
        border-radius: var(--radius);
        padding: 1.25rem;
        margin-bottom: 1.5rem;
        box-shadow: var(--shadow-sm);
    }

    .sidebar-title {
        font-size: 1rem;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 1rem;
        padding-bottom: 0.75rem;
        border-bottom: 2px solid var(--primary);
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .sidebar-title i {
        color: var(--primary);
    }

    /* Category List */
    .category-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .category-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.75rem 0;
        border-bottom: 1px solid var(--border);
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .category-item:last-child {
        border-bottom: none;
    }

    .category-item:hover {
        padding-left: 0.5rem;
    }

    .category-item a {
        color: var(--text-secondary);
        text-decoration: none;
        font-size: 0.9rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        transition: color 0.2s;
    }

    .category-item a i {
        color: var(--text-muted);
        font-size: 0.75rem;
        transition: color 0.2s;
    }

    .category-item:hover a,
    .category-item.active a {
        color: var(--primary);
    }

    .category-item:hover a i,
    .category-item.active a i {
        color: var(--primary);
    }

    .category-item.active {
        background: #eff6ff;
        margin: 0 -1.25rem;
        padding: 0.75rem 1.25rem;
        padding-left: 1.25rem;
        border-left: 3px solid var(--primary);
    }

    .category-count {
        font-size: 0.8rem;
        color: var(--text-muted);
        background: var(--bg-light);
        padding: 0.2rem 0.5rem;
        border-radius: 10px;
    }

    /* Price Filter */
    .price-range-wrapper {
        margin-bottom: 1rem;
    }

    .price-range {
        width: 100%;
        height: 6px;
        -webkit-appearance: none;
        appearance: none;
        background: var(--border);
        border-radius: 3px;
        outline: none;
    }

    .price-range::-webkit-slider-thumb {
        -webkit-appearance: none;
        appearance: none;
        width: 20px;
        height: 20px;
        background: var(--primary);
        border-radius: 50%;
        cursor: pointer;
        box-shadow: 0 2px 6px rgba(30, 64, 175, 0.3);
        transition: transform 0.2s;
    }

    .price-range::-webkit-slider-thumb:hover {
        transform: scale(1.1);
    }

    .price-display {
        display: flex;
        justify-content: space-between;
        margin-top: 0.75rem;
        font-size: 0.85rem;
        color: var(--text-secondary);
    }

    .price-current {
        text-align: center;
        padding: 0.5rem;
        background: var(--bg-light);
        border-radius: var(--radius-sm);
        margin-top: 0.75rem;
        font-weight: 600;
        color: var(--primary);
    }

    .filter-btn {
        width: 100%;
        padding: 0.75rem;
        background: var(--primary);
        color: white;
        border: none;
        border-radius: var(--radius-sm);
        font-weight: 600;
        font-size: 0.9rem;
        cursor: pointer;
        transition: all 0.2s;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        margin-top: 1rem;
    }

    .filter-btn:hover {
        background: var(--primary-dark);
    }

    .filter-btn.applied {
        background: var(--success);
    }

    /* Featured Products in Sidebar */
    .featured-item {
        display: flex;
        gap: 0.75rem;
        padding: 0.75rem 0;
        border-bottom: 1px solid var(--border);
        transition: all 0.2s;
    }

    .featured-item:last-child {
        border-bottom: none;
    }

    .featured-item:hover {
        background: var(--bg-light);
        margin: 0 -1.25rem;
        padding: 0.75rem 1.25rem;
        border-radius: var(--radius-sm);
    }

    .featured-item-image {
        width: 70px;
        height: 70px;
        border-radius: var(--radius-sm);
        overflow: hidden;
        flex-shrink: 0;
        background: var(--bg-light);
    }

    .featured-item-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .featured-item-info {
        flex: 1;
        min-width: 0;
    }

    .featured-item-name {
        font-size: 0.85rem;
        font-weight: 600;
        color: var(--text-primary);
        margin-bottom: 0.25rem;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .featured-item-rating {
        display: flex;
        gap: 2px;
        margin-bottom: 0.25rem;
    }

    .featured-item-rating i {
        font-size: 0.7rem;
        color: var(--warning);
    }

    .featured-item-rating i.empty {
        color: var(--border);
    }

    .featured-item-price {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .featured-item-price .current {
        font-weight: 700;
        color: var(--text-primary);
        font-size: 0.9rem;
    }

    .featured-item-price .original {
        font-size: 0.8rem;
        color: var(--text-muted);
        text-decoration: line-through;
    }

    .view-more-btn {
        display: block;
        width: 100%;
        padding: 0.75rem;
        background: var(--bg-light);
        color: var(--primary);
        border: 1px solid var(--primary);
        border-radius: var(--radius-sm);
        font-weight: 600;
        font-size: 0.9rem;
        text-align: center;
        text-decoration: none;
        transition: all 0.2s;
        margin-top: 1rem;
    }

    .view-more-btn:hover {
        background: var(--primary);
        color: white;
    }

    /* ==================== MAIN CONTENT ==================== */
    .shop-toolbar {
        display: flex;
        flex-wrap: wrap;
        gap: 1rem;
        margin-bottom: 1.5rem;
        align-items: center;
    }

    .search-box {
        flex: 1;
        min-width: 280px;
        display: flex;
        border: 1px solid var(--border);
        border-radius: var(--radius-sm);
        overflow: hidden;
        background: var(--bg-card);
        transition: all 0.2s;
    }

    .search-box:focus-within {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(30, 64, 175, 0.1);
    }

    .search-box input {
        flex: 1;
        padding: 0.875rem 1rem;
        border: none;
        font-size: 0.925rem;
        outline: none;
    }

    .search-box button {
        padding: 0.875rem 1.25rem;
        background: var(--primary);
        color: white;
        border: none;
        cursor: pointer;
        transition: background 0.2s;
    }

    .search-box button:hover {
        background: var(--primary-dark);
    }

    .sort-box {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.75rem 1rem;
        background: var(--bg-light);
        border-radius: var(--radius-sm);
        border: 1px solid var(--border);
    }

    .sort-box label {
        font-size: 0.875rem;
        color: var(--text-secondary);
        white-space: nowrap;
    }

    .sort-box select {
        border: none;
        background: transparent;
        font-size: 0.875rem;
        color: var(--text-primary);
        font-weight: 500;
        cursor: pointer;
        padding-right: 1rem;
        outline: none;
    }

    /* ==================== PRODUCT CARDS ==================== */
    .products-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
        gap: 1.5rem;
    }

    .product-card {
        background: var(--bg-card);
        border: 1px solid var(--border);
        border-radius: var(--radius);
        overflow: hidden;
        transition: all 0.3s ease;
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .product-card:hover {
        transform: translateY(-4px);
        box-shadow: var(--shadow-lg);
        border-color: transparent;
    }

    /* Product Image */
    .product-image-wrapper {
        position: relative;
        aspect-ratio: 1;
        overflow: hidden;
        background: var(--bg-light);
    }

    .product-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s ease;
    }

    .product-card:hover .product-image {
        transform: scale(1.05);
    }

    /* Badges */
    .product-badges {
        position: absolute;
        top: 0.75rem;
        left: 0.75rem;
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
        z-index: 2;
    }

    .product-badge {
        padding: 0.35rem 0.75rem;
        border-radius: 4px;
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }

    .product-badge.featured {
        background: var(--primary);
        color: white;
    }

    .product-badge.sale {
        background: var(--danger);
        color: white;
    }

    .product-badge.new {
        background: var(--success);
        color: white;
    }

    /* Quick View */
    .product-quick-view {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%) scale(0);
        opacity: 0;
        transition: all 0.3s ease;
        z-index: 3;
    }

    .product-card:hover .product-quick-view {
        transform: translate(-50%, -50%) scale(1);
        opacity: 1;
    }

    .quick-view-btn {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        background: var(--bg-card);
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--text-primary);
        text-decoration: none;
        box-shadow: var(--shadow-md);
        transition: all 0.2s;
    }

    .quick-view-btn:hover {
        background: var(--primary);
        color: white;
        transform: scale(1.1);
    }

    /* Wishlist Button */
    .product-wishlist {
        position: absolute;
        top: 0.75rem;
        right: 0.75rem;
        z-index: 2;
    }

    .wishlist-btn {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: var(--bg-card);
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--text-muted);
        cursor: pointer;
        box-shadow: var(--shadow);
        transition: all 0.2s;
        text-decoration: none;
    }

    .wishlist-btn:hover {
        background: var(--danger);
        color: white;
    }

    .wishlist-btn.active {
        background: var(--danger);
        color: white;
    }

    /* Product Info */
    .product-info {
        padding: 1.25rem;
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .product-name {
        font-size: 0.95rem;
        font-weight: 600;
        color: var(--text-primary);
        margin-bottom: 0.5rem;
        line-height: 1.4;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-decoration: none;
        transition: color 0.2s;
        min-height: 2.7em;
    }

    .product-name:hover {
        color: var(--primary);
    }

    /* Rating */
    .product-rating {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 0.75rem;
    }

    .product-rating-stars {
        display: flex;
        gap: 2px;
    }

    .product-rating-stars i {
        font-size: 0.8rem;
        color: var(--warning);
    }

    .product-rating-stars i.empty {
        color: var(--border);
    }

    .product-rating-count {
        font-size: 0.75rem;
        color: var(--text-muted);
    }

    /* Price */
    .product-price {
        display: flex;
        align-items: baseline;
        gap: 0.5rem;
        margin-bottom: 1rem;
    }

    .product-price-current {
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--text-primary);
    }

    .product-price-current.discounted {
        color: var(--danger);
    }

    .product-price-original {
        font-size: 0.9rem;
        color: var(--text-muted);
        text-decoration: line-through;
    }

    .product-price-savings {
        font-size: 0.75rem;
        color: var(--success);
        font-weight: 600;
    }

    /* Add to Cart */
    .product-actions {
        margin-top: auto;
    }

    .add-to-cart-btn {
        width: 100%;
        padding: 0.75rem 1rem;
        background: var(--text-primary);
        color: white;
        border: none;
        border-radius: var(--radius-sm);
        font-weight: 600;
        font-size: 0.875rem;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        transition: all 0.2s;
        text-decoration: none;
    }

    .add-to-cart-btn:hover {
        background: var(--primary);
        color: white;
        transform: translateY(-1px);
    }

    /* No Products */
    .no-products {
        text-align: center;
        padding: 4rem 2rem;
        color: var(--text-muted);
    }

    .no-products-icon {
        width: 80px;
        height: 80px;
        background: var(--bg-light);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
    }

    .no-products-icon i {
        font-size: 2rem;
        color: var(--text-muted);
    }

    .no-products h4 {
        color: var(--text-primary);
        margin-bottom: 0.5rem;
    }

    .no-products p {
        margin: 0;
    }

    /* ==================== BANNER SECTION ==================== */
    .promo-banner-section {
        background: var(--bg-card);
        padding: 3rem 0;
    }

    .promo-banner {
        position: relative;
        border-radius: var(--radius-lg);
        overflow: hidden;
        height: 100%;
        min-height: 300px;
    }

    .promo-banner img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .promo-banner-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        padding: 2rem;
    }

    .promo-banner.style-1 .promo-banner-overlay {
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(255, 255, 255, 0.8) 100%);
    }

    .promo-banner.style-2 .promo-banner-overlay {
        background: linear-gradient(135deg, rgba(245, 158, 11, 0.9) 0%, rgba(217, 119, 6, 0.85) 100%);
        text-align: center;
        align-items: center;
    }

    .promo-banner-title {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }

    .promo-banner.style-1 .promo-banner-title {
        color: var(--primary);
    }

    .promo-banner.style-2 .promo-banner-title {
        color: white;
        font-size: 2.5rem;
    }

    .promo-banner-subtitle {
        font-size: 1rem;
        margin-bottom: 1.5rem;
    }

    .promo-banner.style-1 .promo-banner-subtitle {
        color: var(--text-secondary);
    }

    .promo-banner.style-2 .promo-banner-subtitle {
        color: white;
        font-size: 1.25rem;
    }

    .promo-banner-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.75rem 1.5rem;
        border-radius: 50px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.2s;
    }

    .promo-banner.style-1 .promo-banner-btn {
        background: var(--primary);
        color: white;
    }

    .promo-banner.style-1 .promo-banner-btn:hover {
        background: var(--primary-dark);
        color: white;
    }

    .promo-banner.style-2 .promo-banner-btn {
        background: white;
        color: var(--warning);
    }

    .promo-banner.style-2 .promo-banner-btn:hover {
        background: var(--text-primary);
        color: white;
    }

    /* ==================== RESPONSIVE ==================== */
    @media (max-width: 992px) {
        .shop-sidebar {
            position: static;
            margin-bottom: 2rem;
        }

        .sidebar-card {
            margin-bottom: 1rem;
        }

        .products-grid {
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        }
    }

    @media (max-width: 768px) {
        .offer-card-inner {
            flex-direction: column;
            text-align: center;
            padding: 1.5rem;
        }

        .offer-card-content {
            padding-right: 0;
            margin-bottom: 1rem;
        }

        .offer-card-image {
            width: 120px;
            height: 120px;
        }

        .shop-toolbar {
            flex-direction: column;
        }

        .search-box {
            width: 100%;
        }

        .sort-box {
            width: 100%;
            justify-content: space-between;
        }

        .products-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
        }

        .product-info {
            padding: 1rem;
        }

        .product-name {
            font-size: 0.85rem;
        }

        .product-price-current {
            font-size: 1rem;
        }
    }

    @media (max-width: 576px) {
        .products-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<!-- ==================== OFFER BANNERS SECTION ==================== -->
<div class="offer-section">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-6">
                <a href="#" class="offer-card primary">
                    <div class="offer-card-inner">
                        <div class="offer-card-content">
                            <p class="offer-card-subtitle">Find The Best Camera for You!</p>
                            <h3 class="offer-card-title">Smart Camera</h3>
                            <p class="offer-card-discount">
                                <span class="number">40%</span> 
                                <span class="text">Off</span>
                            </p>
                        </div>
                        <img src="img/product-1.png" class="offer-card-image" alt="Smart Camera">
                    </div>
                </a>
            </div>
            <div class="col-lg-6">
                <a href="#" class="offer-card warning">
                    <div class="offer-card-inner">
                        <div class="offer-card-content">
                            <p class="offer-card-subtitle">Find The Best Watches for You!</p>
                            <h3 class="offer-card-title">Smart Watch</h3>
                            <p class="offer-card-discount">
                                <span class="number">20%</span> 
                                <span class="text">Off</span>
                            </p>
                        </div>
                        <img src="img/product-2.png" class="offer-card-image" alt="Smart Watch">
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- ==================== SHOP SECTION ==================== -->
<div class="shop-section">
    <div class="container">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-lg-3">
                <div class="shop-sidebar">
                    <!-- Categories -->
                    <div class="sidebar-card">
                        <h4 class="sidebar-title">
                            <i class="bi bi-grid-3x3-gap-fill"></i> Categories
                        </h4>
                        <ul class="category-list">
                            <li class="category-item active">
                                <a href="#" class="category-filter" data-category="all">
                                    <i class="bi bi-chevron-right"></i>
                                    All Products
                                </a>
                                <span class="category-count">{{ $products->count() }}</span>
                            </li>
                            @foreach($categories as $category)
                                <li class="category-item">
                                    <a href="#" class="category-filter" data-category="{{ $category->id }}">
                                        <i class="bi bi-chevron-right"></i>
                                        {{ $category->name }}
                                    </a>
                                    <span class="category-count">{{ $category->products_count }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <!-- Price Filter -->
                    <div class="sidebar-card">
                        <h4 class="sidebar-title">
                            <i class="bi bi-currency-rupee"></i> Price Range
                        </h4>
                        <div class="price-range-wrapper">
                            <input type="range" class="price-range" id="rangeInput" 
                                min="{{ $minPrice ?? 0 }}" 
                                max="{{ $maxPrice ?? 100000 }}" 
                                value="{{ $maxPrice ?? 100000 }}">
                            <div class="price-display">
                                <span>₹{{ number_format($minPrice ?? 0) }}</span>
                                <span>₹{{ number_format($maxPrice ?? 100000) }}</span>
                            </div>
                            <div class="price-current">
                                Max: ₹<span id="priceValue">{{ number_format($maxPrice ?? 100000) }}</span>
                            </div>
                        </div>
                        <button type="button" class="filter-btn" id="applyPriceFilter">
                            <i class="bi bi-funnel-fill"></i> Apply Filter
                        </button>
                    </div>

                    <!-- Featured Products -->
                    <div class="sidebar-card">
                        <h4 class="sidebar-title">
                            <i class="bi bi-star-fill"></i> Featured Products
                        </h4>
                        @foreach($featuredProducts as $featuredProduct)
                            <a href="{{ route('product.show', [$featuredProduct->id, $featuredProduct->slug]) }}" class="featured-item" style="text-decoration: none;">
                                <div class="featured-item-image">
                                    <img src="{{ $featuredProduct->main_image ? asset('storage/' . $featuredProduct->main_image) : asset('img/product-default.png') }}"
                                        alt="{{ $featuredProduct->name }}">
                                </div>
                                <div class="featured-item-info">
                                    <h6 class="featured-item-name">{{ Str::limit($featuredProduct->name, 25) }}</h6>
                                    <div class="featured-item-rating">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= ($featuredProduct->rating ?? 4))
                                                <i class="bi bi-star-fill"></i>
                                            @else
                                                <i class="bi bi-star-fill empty"></i>
                                            @endif
                                        @endfor
                                    </div>
                                    <div class="featured-item-price">
                                        @if($featuredProduct->discount > 0)
                                            <span class="current">₹{{ number_format($featuredProduct->price - ($featuredProduct->price * $featuredProduct->discount / 100)) }}</span>
                                            <span class="original">₹{{ number_format($featuredProduct->price) }}</span>
                                        @else
                                            <span class="current">₹{{ number_format($featuredProduct->price) }}</span>
                                        @endif
                                    </div>
                                </div>
                            </a>
                        @endforeach
                        <a href="{{ route('shop') }}" class="view-more-btn">
                            <i class="bi bi-arrow-right"></i> View All Products
                        </a>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-lg-9">
                <!-- Toolbar -->
                <div class="shop-toolbar">
                    <div class="search-box">
                        <input type="text" id="searchInput" placeholder="Search products...">
                        <button type="button" id="searchButton">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                    <div class="sort-box">
                        <label><i class="bi bi-sort-down me-1"></i> Sort By:</label>
                        <select id="sortSelect">
                            <option value="default">Default</option>
                            <option value="popularity">Popularity</option>
                            <option value="rating">Rating</option>
                            <option value="date">Newest</option>
                            <option value="price-asc">Price: Low to High</option>
                            <option value="price-desc">Price: High to Low</option>
                        </select>
                    </div>
                </div>

                <!-- Products Grid -->
                <div class="products-grid" id="products-container">
                    @foreach($products as $product)
                        <div class="product-card product-item-wrapper"
                            data-category="{{ $product->category_id }}"
                            data-price="{{ $product->price }}"
                            data-rating="{{ $product->rating ?? 0 }}"
                            data-date="{{ $product->created_at->timestamp }}"
                            data-views="{{ $product->views }}"
                            data-name="{{ strtolower($product->name) }}">
                            
                            <div class="product-image-wrapper">
                                <img src="{{ $product->main_image ? asset('storage/' . $product->main_image) : asset('img/product-default.png') }}"
                                    class="product-image" alt="{{ $product->name }}">
                                
                                <!-- Badges -->
                                <div class="product-badges">
                                    @if($product->featured)
                                        <span class="product-badge featured">Featured</span>
                                    @endif
                                    @if($product->discount > 0)
                                        <span class="product-badge sale">-{{ $product->discount }}%</span>
                                    @endif
                                </div>

                                <!-- Wishlist -->
                                <div class="product-wishlist">
                                    <button class="wishlist-btn" data-product-id="{{ $product->id }}">
                                        <i class="bi bi-heart"></i>
                                    </button>
                                </div>

                                <!-- Quick View -->
                                <div class="product-quick-view">
                                    <a href="{{ route('product.show', [$product->id, $product->slug]) }}" class="quick-view-btn">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                </div>
                            </div>

                            <div class="product-info">
                                <a href="{{ route('product.show', [$product->id, $product->slug]) }}" class="product-name">
                                    {{ $product->name }}
                                </a>

                                <div class="product-rating">
                                    <div class="product-rating-stars">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= ($product->rating ?? 4))
                                                <i class="bi bi-star-fill"></i>
                                            @else
                                                <i class="bi bi-star-fill empty"></i>
                                            @endif
                                        @endfor
                                    </div>
                                    <span class="product-rating-count">({{ $product->reviews_count ?? rand(10, 100) }})</span>
                                </div>

                                <div class="product-price">
                                    @if($product->discount > 0)
                                        <span class="product-price-current discounted">
                                            ₹{{ number_format($product->price - ($product->price * $product->discount / 100), 2) }}
                                        </span>
                                        <span class="product-price-original">
                                            ₹{{ number_format($product->price, 2) }}
                                        </span>
                                    @else
                                        <span class="product-price-current">
                                            ₹{{ number_format($product->price, 2) }}
                                        </span>
                                    @endif
                                </div>

                                @if($product->discount > 0)
                                    <span class="product-price-savings">
                                        <i class="bi bi-tag-fill"></i> Save ₹{{ number_format(($product->price * $product->discount / 100), 2) }}
                                    </span>
                                @endif

                                <div class="product-actions">
                                    <a href="#" class="add-to-cart-btn add-to-cart" data-product-id="{{ $product->id }}">
                                        <i class="bi bi-cart-plus"></i> Add to Cart
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- No Products Message -->
                <div class="no-products" id="noProducts" style="display: none;">
                    <div class="no-products-icon">
                        <i class="bi bi-box-seam"></i>
                    </div>
                    <h4>No Products Found</h4>
                    <p>Try adjusting your filters or search terms</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ==================== PROMO BANNER SECTION ==================== -->
<div class="promo-banner-section">
    <div class="container">
        <div class="row g-4">
            @if($amountOffer)
                <div class="col-lg-6">
                    <div class="promo-banner style-1">
                        <img src="{{ asset('storage/' . $amountOffer->product->main_image) }}" alt="{{ $amountOffer->title }}">
                        <div class="promo-banner-overlay">
                            <h3 class="promo-banner-title">{{ $amountOffer->title }}</h3>
                            <p class="promo-banner-subtitle">Special Price: ₹{{ number_format($amountOffer->offer_price, 2) }}</p>
                            <a href="{{ route('product.show', [$amountOffer->product->id, $amountOffer->product->slug]) }}" class="promo-banner-btn">
                                Shop Now <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @endif

            @if($percentageOffer)
                <div class="col-lg-6">
                    <div class="promo-banner style-2">
                        <img src="{{ asset('storage/' . $percentageOffer->product->main_image) }}" alt="{{ $percentageOffer->title }}">
                        <div class="promo-banner-overlay">
                            <h2 class="promo-banner-title">SALE</h2>
                            <p class="promo-banner-subtitle">Get Up To {{ $percentageOffer->offer_price }}% Off</p>
                            <a href="{{ route('product.show', [$percentageOffer->product->id, $percentageOffer->product->slug]) }}" class="promo-banner-btn">
                                Shop Now <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const productsContainer = document.getElementById('products-container');
    const allProducts = Array.from(document.querySelectorAll('.product-item-wrapper'));
    const categoryFilters = document.querySelectorAll('.category-filter');
    const priceRange = document.getElementById('rangeInput');
    const priceValue = document.getElementById('priceValue');
    const applyPriceButton = document.getElementById('applyPriceFilter');
    const searchInput = document.getElementById('searchInput');
    const searchButton = document.getElementById('searchButton');
    const sortSelect = document.getElementById('sortSelect');
    const noProductsDiv = document.getElementById('noProducts');

    let currentCategory = 'all';
    let currentMaxPrice = parseFloat(priceRange.max);
    let appliedMaxPrice = parseFloat(priceRange.max);
    let currentSearchTerm = '';
    let currentSort = 'default';

    // Format number with commas
    function formatNumber(num) {
        return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    // Category filtering
    categoryFilters.forEach(filter => {
        filter.addEventListener('click', function(e) {
            e.preventDefault();
            currentCategory = this.getAttribute('data-category');

            // Update active state
            document.querySelectorAll('.category-item').forEach(item => {
                item.classList.remove('active');
            });
            this.closest('.category-item').classList.add('active');

            filterAndDisplayProducts();
        });
    });

    // Price range update
    priceRange.addEventListener('input', function() {
        currentMaxPrice = parseFloat(this.value);
        priceValue.textContent = formatNumber(Math.round(currentMaxPrice));
    });

    // Apply price filter
    applyPriceButton.addEventListener('click', function() {
        appliedMaxPrice = currentMaxPrice;

        // Visual feedback
        this.innerHTML = '<i class="bi bi-check-lg"></i> Applied!';
        this.classList.add('applied');

        setTimeout(() => {
            this.innerHTML = '<i class="bi bi-funnel-fill"></i> Apply Filter';
            this.classList.remove('applied');
        }, 1500);

        filterAndDisplayProducts();
    });

    // Search
    searchButton.addEventListener('click', function() {
        currentSearchTerm = searchInput.value.toLowerCase().trim();
        
        const icon = this.querySelector('i');
        icon.classList.remove('bi-search');
        icon.classList.add('bi-hourglass-split');
        
        setTimeout(() => {
            icon.classList.remove('bi-hourglass-split');
            icon.classList.add('bi-search');
        }, 500);

        filterAndDisplayProducts();
    });

    searchInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            searchButton.click();
        }
    });

    // Sorting
    sortSelect.addEventListener('change', function() {
        currentSort = this.value;
        filterAndDisplayProducts();
    });

    function filterAndDisplayProducts() {
        let filteredProducts = allProducts.filter(product => {
            const productCategory = product.getAttribute('data-category');
            const categoryMatch = currentCategory === 'all' || productCategory === currentCategory;

            const productPrice = parseFloat(product.getAttribute('data-price'));
            const priceMatch = productPrice <= appliedMaxPrice;

            const productName = product.getAttribute('data-name');
            const searchMatch = currentSearchTerm === '' || productName.includes(currentSearchTerm);

            return categoryMatch && priceMatch && searchMatch;
        });

        filteredProducts = sortProducts(filteredProducts);

        productsContainer.innerHTML = '';

        if (filteredProducts.length > 0) {
            filteredProducts.forEach(product => {
                productsContainer.appendChild(product.cloneNode(true));
            });
            noProductsDiv.style.display = 'none';
            productsContainer.style.display = 'grid';
        } else {
            noProductsDiv.style.display = 'block';
            productsContainer.style.display = 'none';
        }

        attachProductEventListeners();
    }

    function sortProducts(products) {
        switch (currentSort) {
            case 'price-asc':
                return products.sort((a, b) => parseFloat(a.getAttribute('data-price')) - parseFloat(b.getAttribute('data-price')));
            case 'price-desc':
                return products.sort((a, b) => parseFloat(b.getAttribute('data-price')) - parseFloat(a.getAttribute('data-price')));
            case 'rating':
                return products.sort((a, b) => parseFloat(b.getAttribute('data-rating')) - parseFloat(a.getAttribute('data-rating')));
            case 'date':
                return products.sort((a, b) => parseFloat(b.getAttribute('data-date')) - parseFloat(a.getAttribute('data-date')));
            case 'popularity':
                return products.sort((a, b) => parseFloat(b.getAttribute('data-views')) - parseFloat(a.getAttribute('data-views')));
            default:
                return products;
        }
    }

    function attachProductEventListeners() {
        // Add to cart
        document.querySelectorAll('.add-to-cart').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                const productId = this.getAttribute('data-product-id');
                
                // Add loading state
                const originalText = this.innerHTML;
                this.innerHTML = '<i class="bi bi-hourglass-split"></i> Adding...';
                this.style.pointerEvents = 'none';

                // AJAX call to add to cart
                fetch(`/cart/add/${productId}`, {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        return response.json().then(data => { throw data; });
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        this.innerHTML = '<i class="bi bi-check-lg"></i> Added!';
                        this.style.background = '#059669';
                        
                        // Update cart count if element exists
                        const cartCount = document.querySelector('.cart-count');
                        if (cartCount && data.cart_count) {
                            cartCount.textContent = data.cart_count;
                        }
                        
                        setTimeout(() => {
                            this.innerHTML = originalText;
                            this.style.background = '';
                            this.style.pointerEvents = 'auto';
                        }, 2000);
                    }
                })
                .catch(error => {
                    if (error.redirect) {
                        window.location.href = error.redirect;
                    } else {
                        this.innerHTML = '<i class="bi bi-x-lg"></i> Error';
                        this.style.background = '#dc2626';
                        
                        setTimeout(() => {
                            this.innerHTML = originalText;
                            this.style.background = '';
                            this.style.pointerEvents = 'auto';
                        }, 2000);
                    }
                });
            });
        });

        // Wishlist
        document.querySelectorAll('.wishlist-btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                const productId = this.getAttribute('data-product-id');
                
                this.classList.toggle('active');
                const icon = this.querySelector('i');
                
                if (this.classList.contains('active')) {
                    icon.classList.remove('bi-heart');
                    icon.classList.add('bi-heart-fill');
                } else {
                    icon.classList.remove('bi-heart-fill');
                    icon.classList.add('bi-heart');
                }

                // Add your wishlist AJAX logic here
                console.log('Wishlist toggled for product:', productId);
            });
        });
    }

    // Initial setup
    attachProductEventListeners();
});
</script>
    <br><br>
    <!-- Product Banner End -->
@endsection