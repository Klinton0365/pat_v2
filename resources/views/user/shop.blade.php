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


    <!-- Products Offer Start -->
    {{-- <div class="container-fluid bg-light py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-6 wow fadeInLeft" data-wow-delay="0.2s">
                    <a href="#" class="d-flex align-items-center justify-content-between border bg-white rounded p-4">
                        <div>
                            <p class="text-muted mb-3">Find The Best Camera for You!</p>
                            <h3 class="text-primary">Smart Camera</h3>
                            <h1 class="display-3 text-secondary mb-0">40% <span class="text-primary fw-normal">Off</span>
                            </h1>
                        </div>
                        <img src="img/product-1.png" class="img-fluid" alt="">
                    </a>
                </div>
                <div class="col-lg-6 wow fadeInRight" data-wow-delay="0.3s">
                    <a href="#" class="d-flex align-items-center justify-content-between border bg-white rounded p-4">
                        <div>
                            <p class="text-muted mb-3">Find The Best Whatches for You!</p>
                            <h3 class="text-primary">Smart Whatch</h3>
                            <h1 class="display-3 text-secondary mb-0">20% <span class="text-primary fw-normal">Off</span>
                            </h1>
                        </div>
                        <img src="img/product-2.png" class="img-fluid" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- Products Offer End -->


    <!-- Shop Page Start -->
    <div class="container-fluid shop py-5" style="background:white;">
        <div class="container py-5">
            <div class="row g-4">
                {{-- Sidebar --}}
                <div class="col-lg-2 wow fadeInUp" data-wow-delay="0.1s">
                    {{-- Categories Section --}}
                    <div class="product-categories mb-4">
                        <h4>Product Categories</h4>
                        <ul class="list-unstyled">
                            <li>
                                <div class="categories-item">
                                    <a href="#" class="text-dark category-filter" data-category="all">
                                        <i class="fas fa-th text-secondary me-2"></i>
                                        All Products
                                    </a>
                                    <span>({{ $products->count() }})</span>
                                </div>
                            </li>
                            @foreach($categories as $category)
                                <li>
                                    <div class="categories-item">
                                        <a href="#" class="text-dark category-filter" data-category="{{ $category->id }}">
                                            <i class="fas fa-apple-alt text-secondary me-2"></i>
                                            {{ $category->name }}
                                        </a>
                                        <span>({{ $category->products_count }})</span>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>


                    <!-- Price Filter with Button -->

                    <div class="price mb-4">
                        <h4 class="mb-2">Price</h4>
                        <input type="range" class="form-range w-100" id="rangeInput" name="rangeInput"
                            min="{{ $minPrice ?? 0 }}" max="{{ $maxPrice ?? 1000 }}" value="{{ $maxPrice ?? 1000 }}">
                        <div class="d-flex justify-content-between mt-2">
                            <span>$<span id="minPriceDisplay">{{ number_format($minPrice ?? 0, 2) }}</span></span>
                            <span>$<span id="maxPriceDisplay">{{ number_format($maxPrice ?? 1000, 2) }}</span></span>
                        </div>
                        <output id="amount" name="amount" for="rangeInput" class="d-block text-center mt-2">
                            Max: ₹{{ number_format($maxPrice ?? 1000, 2) }}
                        </output>
                        <button type="button" id="applyPriceFilter" class="btn btn-primary w-100 mt-3">
                            <i class="fas fa-filter me-2"></i>Apply Filter
                        </button>
                    </div>

                    {{-- Featured Products --}}
                    <div class="featured-product mb-4">
                        <h4 class="mb-3">Featured Products</h4>
                        @foreach($featuredProducts as $featuredProduct)
                            <div class="featured-product-item d-flex mb-3">
                                <div class="rounded me-3" style="width: 100px; height: 100px;">
                                    <img src="{{ $featuredProduct->main_image ? asset('storage/' . $featuredProduct->main_image) : asset('img/product-default.png') }}"
                                        style="width: 100px; height: 50px;" class="img-fluid rounded"
                                        alt="{{ $featuredProduct->name }}">
                                </div>
                                <div>
                                    <h6 class="mb-2">{{ Str::limit($featuredProduct->name, 20) }}</h6>
                                    <div class="d-flex mb-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= ($featuredProduct->rating ?? 4))
                                                <i class="fa fa-star text-warning"></i>
                                            @else
                                                <i class="fa fa-star text-muted"></i>
                                            @endif
                                        @endfor
                                    </div>
                                    <div class="d-flex mb-2">
                                        @if($featuredProduct->discount > 0)
                                            <h5 class="fw-bold me-2">
                                                ₹{{ number_format($featuredProduct->price - ($featuredProduct->price * $featuredProduct->discount / 100)) }}
                                            </h5>
                                            <h5 class="text-danger text-decoration-line-through">
                                                ₹{{ number_format($featuredProduct->price) }}</h5>
                                        @else
                                            <h5 class="fw-bold me-2">₹{{ number_format($featuredProduct->price) }}</h5>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div class="d-flex justify-content-center my-4">
                            <a href="{{ route('shop') }}" class="btn btn-primary px-4 py-3 rounded-pill w-100">View More</a>
                        </div>
                    </div>
                </div>

                {{-- Main Content --}}
                <div class="col-lg-10 wow fadeInUp" data-wow-delay="0.1s">
                    {{-- Search and Sort --}}
                    <div class="row g-4 mb-4">
                        <div class="col-xl-7">
                            <div class="input-group w-100 mx-auto d-flex">
                                <input type="search" class="form-control p-3" placeholder="Search products..."
                                    id="searchInput" aria-describedby="search-icon-1">
                                <button class="input-group-text p-3 btn btn-primary" id="searchButton"
                                    style="cursor: pointer; border: none;">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-xl-5">
                            <div class="bg-light ps-3 py-3 rounded d-flex justify-content-between align-items-center">
                                <label for="sortSelect" class="mb-0">Sort By:</label>
                                <select id="sortSelect" class="border-0 form-select-sm bg-light me-3">
                                    <option value="default">Default Sorting</option>
                                    <option value="popularity">Popularity</option>
                                    <option value="rating">Average Rating</option>
                                    <option value="date">Newest First</option>
                                    <option value="price-asc">Price: Low to High</option>
                                    <option value="price-desc">Price: High to Low</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <style>
                        .product-card-minimal {
                            background: white;
                            border-radius: 16px;
                            overflow: hidden;
                            transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
                            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
                            height: 100%;
                            display: flex;
                            flex-direction: column;
                        }

                        .product-card-minimal:hover {
                            transform: translateY(-8px);
                            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
                        }

                        .product-card-minimal .image-wrapper {
                            position: relative;
                            overflow: hidden;
                            background: #f8f9fa;
                            aspect-ratio: 1;
                        }

                        .product-card-minimal .product-img {
                            width: 100%;
                            height: 100%;
                            object-fit: cover;
                            transition: transform 0.6s ease;
                        }

                        .product-card-minimal:hover .product-img {
                            transform: scale(1.05);
                        }

                        .product-card-minimal .badges {
                            position: absolute;
                            top: 12px;
                            left: 12px;
                            display: flex;
                            flex-direction: column;
                            gap: 8px;
                            z-index: 2;
                        }

                        .product-card-minimal .badge {
                            background: white;
                            color: #333;
                            padding: 6px 14px;
                            border-radius: 6px;
                            font-size: 12px;
                            font-weight: 600;
                            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
                        }

                        .product-card-minimal .badge.featured {
                            background: linear-gradient(135deg, #3dcbffff 0%, #75c4ebff 100%);
                            color: white;
                            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
                        }

                        .product-card-minimal .badge.sale {
                            background: #ff3b30;
                            color: white;
                        }

                        .product-card-minimal .quick-view {
                            position: absolute;
                            top: 50%;
                            left: 50%;
                            transform: translate(-50%, -50%) scale(0);
                            opacity: 0;
                            transition: all 0.3s ease;
                            z-index: 3;
                        }

                        .product-card-minimal:hover .quick-view {
                            transform: translate(-50%, -50%) scale(1);
                            opacity: 1;
                        }

                        .product-card-minimal .quick-view-btn {
                            background: white;
                            border: none;
                            width: 50px;
                            height: 50px;
                            border-radius: 50%;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            cursor: pointer;
                            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
                            transition: all 0.2s ease;
                            text-decoration: none;
                            color: #333;
                        }

                        .product-card-minimal .quick-view-btn:hover {
                            transform: scale(1.1);
                            background: #000;
                            color: white;
                        }

                        .product-card-minimal .product-info {
                            padding: 20px;
                            flex: 1;
                            display: flex;
                            flex-direction: column;
                        }

                        .product-card-minimal .product-name {
                            font-size: 16px;
                            font-weight: 600;
                            color: #1d1d1f;
                            margin-bottom: 8px;
                            display: -webkit-box;
                            -webkit-line-clamp: 2;
                            -webkit-box-orient: vertical;
                            overflow: hidden;
                            line-height: 1.4;
                            min-height: 44px;
                            text-decoration: none;
                            transition: color 0.2s ease;
                        }

                        .product-card-minimal .product-name:hover {
                            color: #0066cc;
                        }

                        .product-card-minimal .price-section {
                            margin-bottom: 5px;
                        }

                        .product-card-minimal .price-current {
                            font-size: 20px;
                            font-weight: 700;
                            color: #1d1d1f;
                        }

                        .product-card-minimal .price-original {
                            font-size: 16px;
                            color: #86868b;
                            text-decoration: line-through;
                            margin-left: 8px;
                        }

                        .product-card-minimal .actions {
                            display: flex;
                            gap: 8px;
                            margin-top: auto;
                        }

                        .product-card-minimal .btn-add-cart {
                            flex: 1;
                            background: #1d1d1f;
                            color: white;
                            border: none;
                            padding: 12px;
                            border-radius: 8px;
                            font-weight: 600;
                            font-size: 14px;
                            cursor: pointer;
                            transition: all 0.2s ease;
                            text-decoration: none;
                            display: inline-flex;
                            align-items: center;
                            justify-content: center;
                        }

                        .product-card-minimal .btn-add-cart:hover {
                            background: #000;
                            transform: translateY(-2px);
                            color: white;
                        }

                        .product-card-minimal .btn-wishlist {
                            width: 44px;
                            height: 44px;
                            background: #f5f5f7;
                            border: none;
                            border-radius: 8px;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            cursor: pointer;
                            transition: all 0.2s ease;
                            text-decoration: none;
                            color: #1d1d1f;
                        }

                        .product-card-minimal .btn-wishlist:hover {
                            background: #ff3b30;
                            color: white;
                            transform: scale(1.05);
                        }

                        .product-card-minimal .rating-stars {
                            display: flex;
                            gap: 2px;
                            margin: 8px 0;
                        }

                        .product-card-minimal .rating-stars i {
                            font-size: 14px;
                        }

                        .product-card-minimal .rating-stars .text-primary {
                            color: #ffd700 !important;
                        }

                        .categories-item {
                            padding: 10px 0;
                            border-bottom: 1px solid #eee;
                            display: flex;
                            justify-content: space-between;
                            align-items: center;
                            cursor: pointer;
                            transition: all 0.3s ease;
                        }

                        .categories-item:hover {
                            padding-left: 10px;
                        }

                        .categories-item a {
                            text-decoration: none;
                            transition: color 0.3s ease;
                        }

                        .categories-item:hover a {
                            color: #0066cc !important;
                        }

                        .categories-item.active {
                            background-color: #f8f9fa;
                            padding-left: 10px;
                            border-left: 3px solid #0066cc;
                        }

                        .categories-item.active a {
                            color: #0066cc !important;
                            font-weight: 600;
                        }

                        .no-products {
                            text-align: center;
                            padding: 60px 20px;
                            color: #86868b;
                        }

                        .no-products i {
                            font-size: 64px;
                            margin-bottom: 20px;
                            opacity: 0.3;
                        }
                    </style>

                    {{-- Products Grid --}}
                    <div class="row g-4" id="products-container">
                        @foreach($products as $product)
                            <div class="col-md-6 col-lg-4 col-xl-3 product-item-wrapper"
                                data-category="{{ $product->category_id }}" data-price="{{ $product->price }}"
                                data-rating="{{ $product->rating ?? 0 }}" data-date="{{ $product->created_at->timestamp }}"
                                data-views="{{ $product->views }}" data-name="{{ strtolower($product->name) }}">

                                <div class="product-card-minimal">
                                    <div class="image-wrapper">
                                        <img src="{{ $product->main_image ? asset('storage/' . $product->main_image) : asset('img/product-default.png') }}"
                                            class="product-img" alt="{{ $product->name }}">

                                        <div class="badges">
                                            @if($product->featured)
                                                <span class="badge featured">Featured</span>
                                            @endif
                                            @if($product->discount > 0)
                                                <span class="badge sale">-{{ $product->discount }}%</span>
                                            @endif
                                        </div>

                                        <div class="quick-view">
                                            <a href="{{ route('product.show', [$product->id, $product->slug]) }}"
                                                class="quick-view-btn">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="product-info">
                                        <a href="{{ route('product.show', [$product->id, $product->slug]) }}"
                                            class="product-name">
                                            {{ $product->name }}
                                        </a>

                                        <div class="price-section">
                                            @if($product->discount > 0)
                                                <span class="price-current">
                                                    ₹{{ number_format($product->price - ($product->price * $product->discount / 100), 2) }}
                                                </span>
                                                <span class="price-original">
                                                    ₹{{ number_format($product->price, 2) }}
                                                </span>
                                            @else
                                                <span class="price-current">
                                                    ₹{{ number_format($product->price, 2) }}
                                                </span>
                                            @endif
                                        </div>

                                        <div class="rating-stars">
                                            @for($i = 1; $i <= 5; $i++)
                                                @if($i <= ($product->rating ?? 4))
                                                    <i class="fas fa-star text-primary"></i>
                                                @else
                                                    <i class="fas fa-star" style="color: #d1d5db;"></i>
                                                @endif
                                            @endfor
                                        </div>

                                        <div class="actions">
                                            <a href="#" class="btn-add-cart add-to-cart" data-product-id="{{ $product->id }}">
                                                <i class="fas fa-shopping-cart me-2"></i> Add to Cart
                                            </a>
                                            <a href="#" class="btn-wishlist wishlist-btn" data-product-id="{{ $product->id }}">
                                                <i class="fas fa-heart"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="no-products" style="display: none;">
                        <i class="fas fa-box-open"></i>
                        <h4>No products found</h4>
                        <p>Try adjusting your filters or search terms</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const productsContainer = document.getElementById('products-container');
            const allProducts = Array.from(document.querySelectorAll('.product-item-wrapper'));
            const categoryFilters = document.querySelectorAll('.category-filter');
            const priceRange = document.getElementById('rangeInput');
            const priceOutput = document.getElementById('amount');
            const applyPriceButton = document.getElementById('applyPriceFilter');
            const searchInput = document.getElementById('searchInput');
            const searchButton = document.getElementById('searchButton');
            const sortSelect = document.getElementById('sortSelect');
            const noProductsDiv = document.querySelector('.no-products');

            let currentCategory = 'all';
            let currentMaxPrice = parseFloat(priceRange.max);
            let appliedMaxPrice = parseFloat(priceRange.max); // The price that's actually applied
            let currentSearchTerm = '';
            let currentSort = 'default';

            // Category filtering
            categoryFilters.forEach(filter => {
                filter.addEventListener('click', function (e) {
                    e.preventDefault();
                    currentCategory = this.getAttribute('data-category');

                    // Update active state
                    document.querySelectorAll('.categories-item').forEach(item => {
                        item.classList.remove('active');
                    });
                    this.closest('.categories-item').classList.add('active');

                    filterAndDisplayProducts();
                });
            });

            // Price range update (just updates display, doesn't filter)
            priceRange.addEventListener('input', function () {
                currentMaxPrice = parseFloat(this.value);
                priceOutput.textContent = `Max: $${currentMaxPrice.toFixed(2)}`;
            });

            // Apply price filter button
            applyPriceButton.addEventListener('click', function () {
                appliedMaxPrice = currentMaxPrice;

                // Visual feedback
                this.innerHTML = '<i class="fas fa-check me-2"></i>Applied';
                this.classList.add('btn-success');
                this.classList.remove('btn-primary');

                setTimeout(() => {
                    this.innerHTML = '<i class="fas fa-filter me-2"></i>Apply Filter';
                    this.classList.remove('btn-success');
                    this.classList.add('btn-primary');
                }, 1000);

                filterAndDisplayProducts();
            });

            // Search button click
            searchButton.addEventListener('click', function () {
                currentSearchTerm = searchInput.value.toLowerCase().trim();

                // Visual feedback
                const icon = this.querySelector('i');
                icon.classList.remove('fa-search');
                icon.classList.add('fa-spinner', 'fa-spin');

                setTimeout(() => {
                    icon.classList.remove('fa-spinner', 'fa-spin');
                    icon.classList.add('fa-search');
                }, 500);

                filterAndDisplayProducts();
            });

            // Also allow Enter key to trigger search
            searchInput.addEventListener('keypress', function (e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    searchButton.click();
                }
            });

            // Sorting
            sortSelect.addEventListener('change', function () {
                currentSort = this.value;
                filterAndDisplayProducts();
            });

            function filterAndDisplayProducts() {
                let filteredProducts = allProducts.filter(product => {
                    // Category filter
                    const productCategory = product.getAttribute('data-category');
                    const categoryMatch = currentCategory === 'all' || productCategory === currentCategory;

                    // Price filter (use appliedMaxPrice instead of currentMaxPrice)
                    const productPrice = parseFloat(product.getAttribute('data-price'));
                    const priceMatch = productPrice <= appliedMaxPrice;

                    // Search filter
                    const productName = product.getAttribute('data-name');
                    const searchMatch = currentSearchTerm === '' || productName.includes(currentSearchTerm);

                    return categoryMatch && priceMatch && searchMatch;
                });

                // Sort products
                filteredProducts = sortProducts(filteredProducts);

                // Clear container
                productsContainer.innerHTML = '';

                // Display products or no products message
                if (filteredProducts.length > 0) {
                    filteredProducts.forEach(product => {
                        productsContainer.appendChild(product.cloneNode(true));
                    });
                    noProductsDiv.style.display = 'none';
                    productsContainer.style.display = 'flex';
                } else {
                    noProductsDiv.style.display = 'block';
                    productsContainer.style.display = 'none';
                }

                // Reinitialize WOW animations if available
                if (typeof WOW !== 'undefined') {
                    new WOW().init();
                }

                // Reattach event listeners for new elements
                attachProductEventListeners();
            }

            function sortProducts(products) {
                switch (currentSort) {
                    case 'price-asc':
                        return products.sort((a, b) => {
                            return parseFloat(a.getAttribute('data-price')) - parseFloat(b.getAttribute('data-price'));
                        });
                    case 'price-desc':
                        return products.sort((a, b) => {
                            return parseFloat(b.getAttribute('data-price')) - parseFloat(a.getAttribute('data-price'));
                        });
                    case 'rating':
                        return products.sort((a, b) => {
                            return parseFloat(b.getAttribute('data-rating')) - parseFloat(a.getAttribute('data-rating'));
                        });
                    case 'date':
                        return products.sort((a, b) => {
                            return parseFloat(b.getAttribute('data-date')) - parseFloat(a.getAttribute('data-date'));
                        });
                    case 'popularity':
                        return products.sort((a, b) => {
                            return parseFloat(b.getAttribute('data-views')) - parseFloat(a.getAttribute('data-views'));
                        });
                    default:
                        return products;
                }
            }

            function attachProductEventListeners() {
                // Add to cart functionality
                document.querySelectorAll('.add-to-cart').forEach(btn => {
                    btn.addEventListener('click', function (e) {
                        e.preventDefault();
                        const productId = this.getAttribute('data-product-id');
                        console.log('Adding product to cart:', productId);
                        // Add your cart logic here
                    });
                });

                // Wishlist functionality
                document.querySelectorAll('.wishlist-btn').forEach(btn => {
                    btn.addEventListener('click', function (e) {
                        e.preventDefault();
                        const productId = this.getAttribute('data-product-id');
                        console.log('Adding product to wishlist:', productId);
                        // Add your wishlist logic here
                    });
                });
            }

            // Initial event listener attachment
            attachProductEventListeners();
        });
    </script>

    {{-- <div class="container-fluid shop py-5">
        <div class="container py-5">
            <div class="row g-4">
                <div class="col-lg-3 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="product-categories mb-4">
                        <h4>Products Categories</h4>
                        <ul class="list-unstyled">
                            <li>
                                <div class="categories-item">
                                    <a href="#" class="text-dark"><i class="fas fa-apple-alt text-secondary me-2"></i>
                                        Accessories</a>
                                    <span>(3)</span>
                                </div>
                            </li>
                            <li>
                                <div class="categories-item">
                                    <a href="#" class="text-dark"><i class="fas fa-apple-alt text-secondary me-2"></i>
                                        Electronics & Computer</a>
                                    <span>(5)</span>
                                </div>
                            </li>
                            <li>
                                <div class="categories-item">
                                    <a href="#" class="text-dark"><i
                                            class="fas fa-apple-alt text-secondary me-2"></i>Laptops & Desktops</a>
                                    <span>(2)</span>
                                </div>
                            </li>
                            <li>
                                <div class="categories-item">
                                    <a href="#" class="text-dark"><i
                                            class="fas fa-apple-alt text-secondary me-2"></i>Mobiles & Tablets</a>
                                    <span>(8)</span>
                                </div>
                            </li>
                            <li>
                                <div class="categories-item">
                                    <a href="#" class="text-dark"><i
                                            class="fas fa-apple-alt text-secondary me-2"></i>SmartPhone & Smart TV</a>
                                    <span>(5)</span>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="price mb-4">
                        <h4 class="mb-2">Price</h4>
                        <input type="range" class="form-range w-100" id="rangeInput" name="rangeInput" min="0" max="500"
                            value="0" oninput="amount.value=rangeInput.value">
                        <output id="amount" name="amount" min-velue="0" max-value="500" for="rangeInput">0</output>
                        <div class=""></div>
                    </div>
                    <div class="featured-product mb-4">
                        <h4 class="mb-3">Featured products</h4>
                        <div class="featured-product-item">
                            <div class="rounded me-4" style="width: 100px; height: 100px;">
                                <img src="img/product-3.png" class="img-fluid rounded" alt="Image">
                            </div>
                            <div>
                                <h6 class="mb-2">SmartPhone</h6>
                                <div class="d-flex mb-2">
                                    <i class="fa fa-star text-secondary"></i>
                                    <i class="fa fa-star text-secondary"></i>
                                    <i class="fa fa-star text-secondary"></i>
                                    <i class="fa fa-star text-secondary"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <div class="d-flex mb-2">
                                    <h5 class="fw-bold me-2">2.99 $</h5>
                                    <h5 class="text-danger text-decoration-line-through">4.11 $</h5>
                                </div>
                            </div>
                        </div>
                        <div class="featured-product-item">
                            <div class="rounded me-4" style="width: 100px; height: 100px;">
                                <img src="img/product-4.png" class="img-fluid rounded" alt="Image">
                            </div>
                            <div>
                                <h6 class="mb-2">Smart Camera</h6>
                                <div class="d-flex mb-2">
                                    <i class="fa fa-star text-secondary"></i>
                                    <i class="fa fa-star text-secondary"></i>
                                    <i class="fa fa-star text-secondary"></i>
                                    <i class="fa fa-star text-secondary"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <div class="d-flex mb-2">
                                    <h5 class="fw-bold me-2">2.99 $</h5>
                                    <h5 class="text-danger text-decoration-line-through">4.11 $</h5>
                                </div>
                            </div>
                        </div>
                        <div class="featured-product-item">
                            <div class="rounded me-4" style="width: 100px; height: 100px;">
                                <img src="img/product-5.png" class="img-fluid rounded" alt="Image">
                            </div>
                            <div>
                                <h6 class="mb-2">Camera Leance</h6>
                                <div class="d-flex mb-2">
                                    <i class="fa fa-star text-secondary"></i>
                                    <i class="fa fa-star text-secondary"></i>
                                    <i class="fa fa-star text-secondary"></i>
                                    <i class="fa fa-star text-secondary"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <div class="d-flex mb-2">
                                    <h5 class="fw-bold me-2">2.99 $</h5>
                                    <h5 class="text-danger text-decoration-line-through">4.11 $</h5>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center my-4">
                            <a href="#" class="btn btn-primary px-4 py-3 rounded-pill w-100">Vew More</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="row g-4">
                        <div class="col-xl-7">
                            <div class="input-group w-100 mx-auto d-flex">
                                <input type="search" class="form-control p-3" placeholder="keywords"
                                    aria-describedby="search-icon-1">
                                <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
                            </div>
                        </div>
                        <div class="col-xl-3 text-end">
                            <div class="bg-light ps-3 py-3 rounded d-flex justify-content-between">
                                <label for="electronics">Sort By:</label>
                                <select id="electronics" name="electronicslist"
                                    class="border-0 form-select-sm bg-light me-3" form="electronicsform">
                                    <option value="volvo">Default Sorting</option>
                                    <option value="volv">Nothing</option>
                                    <option value="sab">Popularity</option>
                                    <option value="saab">Newness</option>
                                    <option value="opel">Average Rating</option>
                                    <option value="audio">Low to high</option>
                                    <option value="audi">High to low</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <style>
                        .product-card-minimal {
                            background: white;
                            border-radius: 16px;
                            overflow: hidden;
                            transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
                            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
                            height: 100%;
                            display: flex;
                            flex-direction: column;
                        }

                        .product-card-minimal:hover {
                            transform: translateY(-8px);
                            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
                        }

                        .product-card-minimal .image-wrapper {
                            position: relative;
                            overflow: hidden;
                            background: #f8f9fa;
                            aspect-ratio: 1;
                        }

                        .product-card-minimal .product-img {
                            width: 100%;
                            height: 100%;
                            object-fit: cover;
                            transition: transform 0.6s ease;
                        }

                        .product-card-minimal:hover .product-img {
                            transform: scale(1.05);
                        }

                        .product-card-minimal .badges {
                            position: absolute;
                            top: 12px;
                            left: 12px;
                            display: flex;
                            flex-direction: column;
                            gap: 8px;
                            z-index: 2;
                        }

                        .product-card-minimal .badge {
                            background: white;
                            color: #333;
                            padding: 6px 14px;
                            border-radius: 6px;
                            font-size: 12px;
                            font-weight: 600;
                            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
                        }

                        /* .product-card-minimal .badge.featured {
                                    background: #000;
                                    color: white;
                                } */
                        .product-card-minimal .badge.featured {
                            background: linear-gradient(135deg, #3dcbffff 0%, #75c4ebff 100%);
                            color: white;
                            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
                        }

                        .product-card-minimal .badge.sale {
                            background: #ff3b30;
                            color: white;
                        }

                        .product-card-minimal .quick-view {
                            position: absolute;
                            top: 50%;
                            left: 50%;
                            transform: translate(-50%, -50%) scale(0);
                            opacity: 0;
                            transition: all 0.3s ease;
                            z-index: 3;
                        }

                        .product-card-minimal:hover .quick-view {
                            transform: translate(-50%, -50%) scale(1);
                            opacity: 1;
                        }

                        .product-card-minimal .quick-view-btn {
                            background: white;
                            border: none;
                            width: 50px;
                            height: 50px;
                            border-radius: 50%;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            cursor: pointer;
                            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
                            transition: all 0.2s ease;
                            text-decoration: none;
                            color: #333;
                        }

                        .product-card-minimal .quick-view-btn:hover {
                            transform: scale(1.1);
                            background: #000;
                            color: white;
                        }

                        .product-card-minimal .product-info {
                            padding: 20px;
                            flex: 1;
                            display: flex;
                            flex-direction: column;
                        }

                        .product-card-minimal .product-name {
                            font-size: 16px;
                            font-weight: 600;
                            color: #1d1d1f;
                            margin-bottom: 8px;
                            display: -webkit-box;
                            -webkit-line-clamp: 2;
                            -webkit-box-orient: vertical;
                            overflow: hidden;
                            line-height: 1.4;
                            min-height: 44px;
                            text-decoration: none;
                            transition: color 0.2s ease;
                        }

                        .product-card-minimal .product-name:hover {
                            color: #0066cc;
                        }

                        .product-card-minimal .price-section {
                            margin-bottom: 5px;
                        }

                        .product-card-minimal .price-current {
                            font-size: 20px;
                            font-weight: 700;
                            color: #1d1d1f;
                        }

                        .product-card-minimal .price-original {
                            font-size: 16px;
                            color: #86868b;
                            text-decoration: line-through;
                            margin-left: 8px;
                        }

                        .product-card-minimal .actions {
                            display: flex;
                            gap: 8px;
                            margin-top: auto;
                        }

                        .product-card-minimal .btn-add-cart {
                            flex: 1;
                            background: #1d1d1f;
                            color: white;
                            border: none;
                            padding: 12px;
                            border-radius: 8px;
                            font-weight: 600;
                            font-size: 14px;
                            cursor: pointer;
                            transition: all 0.2s ease;
                            text-decoration: none;
                            display: inline-flex;
                            align-items: center;
                            justify-content: center;
                        }

                        .product-card-minimal .btn-add-cart:hover {
                            background: #000;
                            transform: translateY(-2px);
                            color: white;
                        }

                        .product-card-minimal .btn-wishlist {
                            width: 44px;
                            height: 44px;
                            background: #f5f5f7;
                            border: none;
                            border-radius: 8px;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            cursor: pointer;
                            transition: all 0.2s ease;
                            text-decoration: none;
                            color: #1d1d1f;
                        }

                        .product-card-minimal .btn-wishlist:hover {
                            background: #ff3b30;
                            color: white;
                            transform: scale(1.05);
                        }

                        .product-card-minimal .rating-stars {
                            display: flex;
                            gap: 2px;
                            margin: 8px;
                        }

                        .product-card-minimal .rating-stars i {
                            font-size: 14px;
                        }

                        .product-card-minimal .rating-stars .text-primary {
                            color: #ffd700 !important;
                        }
                    </style>

                    <div class="container-fluid product py-5" style="background: white;">
                        <div class="container py-5">
                            <div class="tab-class">
                                <div class="row g-4">
                                    <div class="col-lg-4 text-start wow fadeInLeft" data-wow-delay="0.1s">
                                        <h1>Our Products</h1>
                                    </div>
                                    <div class="col-lg-8 text-end wow fadeInRight" data-wow-delay="0.1s">
                                        <ul class="nav nav-pills d-inline-flex text-center mb-5">

                                            <li class="nav-item mb-4">
                                                <a class="d-flex mx-2 py-2 bg-light rounded-pill active"
                                                    data-bs-toggle="pill" href="#tab-all" data-category="all">
                                                    <span class="text-dark" style="width: 130px;">All Products</span>
                                                </a>
                                            </li>


                                            @foreach($categories as $index => $category)
                                            <li class="nav-item mb-4">
                                                <a class="d-flex py-2 mx-2 bg-light rounded-pill" data-bs-toggle="pill"
                                                    href="#tab-{{ $category->id }}" data-category="{{ $category->id }}">
                                                    <span class="text-dark" style="width: 130px;">{{ $category->name
                                                        }}</span>
                                                </a>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>

                                <!-- Tab Content -->
                                <div class="tab-content">
                                    <!-- All Products Tab -->
                                    <div id="tab-all" class="tab-pane fade show p-0 active">
                                        <div class="row g-4" id="products-container">
                                            @foreach($products as $product)
                                            <div class="col-md-6 col-lg-4 col-xl-3 product-item-wrapper"
                                                data-category="{{ $product->category_id }}">


                                                <div class="product-card-minimal">
                                                    <div class="image-wrapper">
                                                        <img src="{{ $product->main_image ? asset('storage/' . $product->main_image) : asset('img/product-default.png') }}"
                                                            class="product-img" alt="{{ $product->name }}">


                                                        <div class="badges">
                                                            @if($product->featured)
                                                            <span class="badge featured">Featured</span>
                                                            @endif

                                                        </div>


                                                        <div class="quick-view">
                                                            <a href="{{ route('product.show', [$product->id, $product->slug]) }}"
                                                                class="quick-view-btn">
                                                                <i class="fa fa-eye"></i>
                                                            </a>
                                                        </div>
                                                    </div>

                                                    <div class="product-info">

                                                        <a href="{{ route('product.show', [$product->id, $product->slug]) }}"
                                                            class="product-name">
                                                            {{ $product->name }}
                                                        </a>


                                                        <div class="price-section">
                                                            @if($product->discount > 0)
                                                            <span class="price-current">
                                                                ${{ number_format($product->price - ($product->price *
                                                                $product->discount / 100), 2) }}
                                                            </span>
                                                            <span class="price-original">
                                                                ${{ number_format($product->price, 2) }}
                                                            </span>
                                                            @else
                                                            <span class="price-current">
                                                                ${{ number_format($product->price, 2) }}
                                                            </span>
                                                            @endif
                                                        </div>


                                                        <div class="rating-stars">
                                                            @for($i = 1; $i <= 5; $i++) @if($i <=($product->rating ?? 4))
                                                                <i class="fas fa-star text-primary"></i>
                                                                @else
                                                                <i class="fas fa-star" style="color: #d1d5db;"></i>
                                                                @endif
                                                                @endfor
                                                        </div>


                                                        <div class="actions">
                                                            <a href="#" class="btn-add-cart add-to-cart"
                                                                data-product-id="{{ $product->id }}">
                                                                <i class="fas fa-shopping-cart me-2"></i> Add to Cart
                                                            </a>
                                                            <a href="#" class="btn-wishlist wishlist-btn"
                                                                data-product-id="{{ $product->id }}">
                                                                <i class="fas fa-heart"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <!-- Individual Category Tabs -->
                                    @foreach($categories as $category)
                                    <div id="tab-{{ $category->id }}" class="tab-pane fade show p-0">
                                        <div class="row g-4">
                                            <!-- Products will be filtered and shown here via JavaScript -->
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            // Only select the actual navigation tab links, not product wrappers
                            const categoryTabs = document.querySelectorAll('.nav-pills [data-category]');
                            const allProducts = document.querySelectorAll('.product-item-wrapper');

                            categoryTabs.forEach(tab => {
                                tab.addEventListener('click', function (e) {
                                    e.preventDefault();

                                    const categoryId = this.getAttribute('data-category');
                                    const targetTabId = this.getAttribute('href');
                                    const targetTab = document.querySelector(targetTabId);

                                    // Remove active class from all tabs
                                    categoryTabs.forEach(t => t.classList.remove('active'));
                                    document.querySelectorAll('.tab-pane').forEach(pane => {
                                        pane.classList.remove('show', 'active');
                                    });

                                    // Add active class to clicked tab
                                    this.classList.add('active');
                                    targetTab.classList.add('show', 'active');

                                    // Filter and display products
                                    if (categoryId === 'all') {
                                        const mainContainer = document.querySelector('#tab-all .row');
                                        mainContainer.innerHTML = '';
                                        allProducts.forEach(product => {
                                            mainContainer.appendChild(product.cloneNode(true));
                                        });
                                    } else {
                                        const categoryContainer = targetTab.querySelector('.row');
                                        categoryContainer.innerHTML = '';
                                        allProducts.forEach(product => {
                                            if (product.getAttribute('data-category') === categoryId) {
                                                categoryContainer.appendChild(product.cloneNode(true));
                                            }
                                        });
                                    }

                                    if (typeof WOW !== 'undefined') {
                                        new WOW().init();
                                    }
                                });
                            });

                            // Add to cart functionality
                            document.addEventListener('click', function (e) {
                                const addToCartBtn = e.target.closest('.add-to-cart');
                                const wishlistBtn = e.target.closest('.wishlist-btn');

                                if (addToCartBtn) {
                                    e.preventDefault();
                                    const productId = addToCartBtn.getAttribute('data-product-id');
                                    console.log('Adding product to cart:', productId);
                                    // Add your cart logic here
                                } else if (wishlistBtn) {
                                    e.preventDefault();
                                    const productId = wishlistBtn.getAttribute('data-product-id');
                                    console.log('Adding product to wishlist:', productId);
                                    // Add your wishlist logic here
                                }
                            });
                        });
                    </script>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- Shop Page End -->

    <!-- Product Banner Start -->
    <div class="container-fluid py-5" style="background:white;">
        <div class="container">
            <div class="row g-4">

                @if($amountOffer)
                    <div class="col-lg-6 wow fadeInLeft" data-wow-delay="0.1s">
                        <a href="{{ route('product.show', [$product->id, $product->slug]) }}">
                            <div class="bg-primary rounded position-relative">
                                <img src="{{ asset('storage/' . $percentageOffer->product->main_image) }}"
                                    class="img-fluid w-100 rounded" alt="{{ $amountOffer->title }}">

                                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex flex-column justify-content-center rounded p-4"
                                    style="background: rgba(255, 255, 255, 0.5);">

                                    <h3 class="display-5 text-primary">
                                        {{ $amountOffer->title }}
                                    </h3>

                                    <p class="fs-4 text-muted">
                                        ₹{{ number_format($amountOffer->offer_price, 2) }}
                                    </p>

                                    <a href="{{ route('product.show', [$product->id, $product->slug]) }}"
                                        class="btn btn-primary rounded-pill align-self-start py-2 px-4">Shop Now</a>
                                </div>
                            </div>
                        </a>
                    </div>
                @endif


                @if($percentageOffer)
                    <div class="col-lg-6 wow fadeInRight" data-wow-delay="0.2s">
                        <a href="{{ route('product.show', [$product->id, $product->slug]) }}">
                            <div class="text-center bg-primary rounded position-relative">
                                <img src="{{ asset('storage/' . $percentageOffer->product->main_image) }}"
                                    class="img-fluid w-100 rounded" alt="{{ $percentageOffer->title }}">

                                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex flex-column justify-content-center rounded p-4"
                                    style="background: rgba(242, 139, 0, 0.5);">

                                    <h2 class="display-2 text-secondary">SALE</h2>
                                    <h4 class="display-5 text-white mb-4">
                                        Get UP To {{ $percentageOffer->offer_price }}% Off
                                    </h4>

                                    <a href="{{ route('product.show', [$product->id, $product->slug]) }}"
                                        class="btn btn-secondary rounded-pill align-self-center py-2 px-4">
                                        Shop Now
                                    </a>
                                </div>
                            </div>
                        </a>
                    </div>
                @endif

            </div>
        </div>
    </div>
    <br><br>
    <!-- Product Banner End -->
@endsection