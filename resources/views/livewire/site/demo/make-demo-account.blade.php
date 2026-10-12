<div x-data="{
    show: false,
    verror: false,
    current: 0,
    selected: $wire.entangle('selectedPlan'),
    step: $wire.entangle('nextStep'),
    susuType: $wire.entangle('susuType'),
    subStep: false,
    portalLink: '',
    completedSteps: {
        owner: false,
        verify: false,
        account: false
    },
    callNext(next, sub = false){
        // Mark current step as completed before moving to next
        if (this.step === 'owner' && next === 'verify') {
            this.completedSteps.owner = true;
        } else if (this.step === 'verify' && next === 'account') {
            this.completedSteps.verify = true;
        } else if (this.step === 'account' && next === 'success') {
            this.completedSteps.account = true;
        }
        this.step = next;
        this.subStep = sub;
        console.log(this.step, this.subStep)
    },
    canClickStep(stepName) {
        // Only allow clicking on completed steps or the current step
        if (stepName === 'owner') return true;
        if (stepName === 'verify') return this.completedSteps.owner;
        if (stepName === 'account') return this.completedSteps.verify;
        return false;
    },
    callPrevious(step){
        this.current = step
        $wire.decreaseStep()
    }
    }" x-init="setTimeout(() => current = 1, 200)"
        x-on:next-step.window="callNext($event.detail.step, $event.detail.subStep)"
        x-on:verify.window="callNext($event.detail.step)"
        x-on:v-error.window="verror=true"
        x-on:portal-ready.window="portalLink = $event.detail[0]">

    <div class="onboard-step-wrapper"
        x-cloak
        x-show="current==1"
        x-transition.opacity
        x-transition.duration.600ms>
        <div class="full-width">
            {{-- <p class="onboard-highlight-text">A smooth ride begins with just 3mins or less to setup</p> --}}
            @if ($this->hasPortalLink())
                <div class="complete-modal">
                    <p class="onboard-hero-text">
                        Your account is ready!
                    </p>

                    <p class="onboard-hero-text">
                        Log in with your unique portal link below to get started.
                    </p>
                    <div class="your-portal-alt">
                        <p>Your Unique Portal is:</p>

                        <div class="demo-link">
                            <b>{{session('demo_setup')['portal_link'] ?? ''}}</b>
                        </div>
                    </div>

                    <div class="onboard-cta-wrapper">
                        <div class="onboard-continue-btn as-pointer" wire:click="goto()">
                            <span class="btn-standard as-pointer">Go to My Portal</span>

                            <div style="line-height: 0" wire:loading wire:target="goto">
                                <x-loaders.rotation class="loader-border green-loader"/>
                            </div>
                        </div>
                    </div>
                </div>
            @else
            <p class="onboard-hero-text">
                Setup your portal in 3 easy steps.
            </p>

            <div class="actual-steps-wrapper">
                <template x-if="step !== 'success'">
                    <div class="progress-steps">
                        <div
                            class="demo-step"
                            :class="step==='owner' ? 'active' : (['owner','verify','account'].includes(step) ? 'completed' : '')">
                            Owner
                        </div>

                        <div
                            class="demo-step"
                            :class="step==='verify' ? 'active' : (['verify','account'].includes(step) ? 'completed' : '')">
                            Verification
                        </div>

                        <div
                            class="demo-step"
                            :class="step==='account' ? 'active' : (step==='success' ? 'completed' : '')">
                            Finish
                        </div>
                    </div>
                </template>

                <div class="onboard-form-wrapper">
                        <div class="available-plans-wrapper as-grid-wrapper"
                            x-show="step==='owner'" x-cloak>

                            <form action="#" wire:submit="addOwner">
                                <x-inputs.special.text
                                    name="ownerName"
                                    label="Owner Full Name"
                                    required
                                />

                                <x-inputs.special.text
                                    name="ownerEmail"
                                    label="Owner Email Address"
                                    required
                                />

                                <x-inputs.special.text
                                    name="ownerPhone"
                                    label="Phone Number"
                                    required
                                />

                                <div class="onboard-cta-wrapper as-relative">
                                    <div class="onboard-continue-btn as-pointer"
                                        >
                                        <button class="btn-reset btn-standard as-pointer" type="submit">Continue</butt>

                                        <div style="line-height: 0" wire:loading wire:target="addOwner">
                                            <x-loaders.rotation class="loader-border green-loader"/>
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>

                    {{-- <template x-if="step==='verify'"> --}}
                        <div class="available-plans-wrapper as-grid-wrapper"
                            x-show="step==='verify'" x-cloak>

                            <div class="error form-error" x-show="verror" x-cloak>
                                Verification code is not correct.
                            </div>

                            <x-inputs.special.text
                                name="verificationCode"
                                label="Verification Code"
                                required
                            />

                            <p class="note">Check your email or phone.</p>

                            <div class="onboard-cta-wrapper as-relative">
                                <div class="onboard-continue-btn as-pointer"
                                    x-on:click="$wire.withVerification()">
                                    <span class="btn-reset btn-standard as-pointer">Continue</span>

                                    <div style="line-height: 0" wire:loading wire:target="withVerification">
                                        <x-loaders.rotation class="loader-border green-loader"/>
                                    </div>
                                </div>
                            </div>

                        </div>
                    {{-- </template> --}}

                    <template x-if="step==='account'">
                        <div class="available-plans-wrapper as-grid-wrapper">
                           <div class="susu-type-field">
                                <label class="susu-type-label">Susu Business Type</label>

                                <input type="hidden" wire:model="susuType">

                                <div class="susu-type-cards">
                                    @foreach ($this->susuTypes() as $type)
                                        <div
                                            class="susu-type-card"
                                            :class="susuType == '{{ $type['id'] }}' ? 'selected' : ''"
                                            @click="$wire.set('susuType', '{{ $type['id'] }}'); susuType = '{{ $type['id'] }}'"
                                            wire:key="susu-type-{{ $type['id'] }}">
                                            <div class="susu-type-check">
                                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                                    <polyline points="20 6 9 17 4 12"></polyline>
                                                </svg>
                                            </div>
                                            <p class="susu-type-name">{{ $type['name'] }}</p>
                                            <div class="susu-type-info">
                                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <circle cx="12" cy="12" r="10"></circle>
                                                    <line x1="12" y1="16" x2="12" y2="12"></line>
                                                    <line x1="12" y1="8" x2="12.01" y2="8"></line>
                                                </svg>
                                                <div class="susu-type-tooltip">
                                                    {{ $type['description'] }}
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                @error('susuType')
                                    <div class="error form-error">{{ $message }}</div>
                                @enderror
                            </div>

                            <x-inputs.special.text
                                name="businessName"
                                label="Business Name"
                                placeholder="Eg. SUSU Enterprise Ventures"
                                required
                            />

                            <x-inputs.special.text
                                name="shortName"
                                label="Short Name"
                                placeholder="Eg. susu"
                                required
                            />

                            <div class="onboard-cta-wrapper as-relative">
                                <div class="onboard-continue-btn as-pointer"
                                    x-on:click="$wire.finalize()">
                                    <span class="btn-reset btn-standard as-pointer">Continue</span>

                                    <div style="line-height: 0" wire:loading wire:target="finalize">
                                        <x-loaders.rotation class="loader-border green-loader"/>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </template>


                    <template x-if="step==='success'">
                        <div class="available-plans-wrapper as-grid-wrapper">
                            <p class="onboard-highlight-text as-center">All setup!</p>
                            {{-- <p>Please wait will we take you to your dashboard.</p> --}}

                            <div class="your-portal">
                                <p>Your dedicated portal link will be:</p>

                                <b><span x-html="portalLink"></span></b>
                            </div>

                            <div class="onboard-cta-wrapper">
                                <div class="onboard-continue-btn as-pointer" wire:click="goto()">
                                    <span class="btn-reset btn-standard as-pointer">Go to My Portal</span>

                                    <div style="line-height: 0" wire:loading wire:target="goto">
                                        <x-loaders.rotation class="loader-border green-loader"/>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </template>

                    <template x-if="step==='failed'">
                        <div class="available-plans-wrapper as-grid-wrapper">
                            <p>Oops! Something went wrong</p>
                            <p>Refresh the page and start again, or</p>
                            <p>Please contat support</p>

                            <div class="onboard-cta-wrapper">
                                <a href="/#contactUs">contact us</a>
                                {{-- <a href="#" class="onboard-continue-btn">Let Go!</a> --}}
                            </div>

                        </div>
                    </template>
                </form>
            </div>
            @endif
        </div>

        <div class="hero-cta">
            <a href="https://wa.me/233545044139" target="_blank" class="btn btn-whatsapp"
                style="display: block;margin: auto;margin-top: 30px;">
                <i class="fab fa-whatsapp"></i> Get Help Via WhatsApp
            </a>
        </div>
    </div>

<style>

    .onboard-step-wrapper {
        max-width: 620px;
        margin: 60px auto;
        padding: 0 20px;
    }

    .full-width {
        width: 100%;
    }

    .complete-modal{
        background: #ffffff;
        border: 1px solid #e5e9ec;
        border-radius: 16px;
        box-shadow: 0 4px 24px rgba(15, 23, 42, 0.06), 0 1px 3px rgba(15, 23, 42, 0.04);
        padding: 40px;
        transition: box-shadow 0.3s ease
    }

    .onboard-hero-text {
        text-align: center;
        font-size: 28px;
        font-weight: 700;
        color: #0f766e;
        margin-bottom: 32px;
        letter-spacing: -0.02em;
    }

    .onboard-highlight-text {
        text-align: center;
        font-size: 18px;
        color: #334155;
        margin-bottom: 16px;
    }

    .onboard-highlight-text.as-center {
        text-align: center;
    }

    /* ===== Card Container ===== */
    .actual-steps-wrapper {
        background: #ffffff;
        border: 1px solid #e5e9ec;
        border-radius: 16px;
        box-shadow: 0 4px 24px rgba(15, 23, 42, 0.06), 0 1px 3px rgba(15, 23, 42, 0.04);
        padding: 40px;
        transition: box-shadow 0.3s ease;
    }

    .actual-steps-wrapper:hover {
        box-shadow: 0 8px 32px rgba(15, 23, 42, 0.08), 0 2px 6px rgba(15, 23, 42, 0.05);
    }

    /* ===== Progress Steps ===== */
    .progress-steps {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        position: relative;
        margin-bottom: 40px;
        padding: 0 8px;
    }

    .demo-step {
        position: relative;
        flex: 1;
        text-align: center;
        font-size: 13px;
        font-weight: 600;
        color: #94a3b8;
        padding-top: 44px;
        letter-spacing: 0.01em;
        transition: color 0.25s ease;
    }

    /* ===== Susu Type Cards ===== */
    .susu-type-field {
        display: flex;
        flex-direction: column;
        gap: 6px;
    }

    .susu-type-label {
        font-size: 13px;
        font-weight: 600;
        color: #475569;
        margin-bottom: 2px;
    }

    .susu-type-cards {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
        gap: 12px;
    }

    .susu-type-card {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        padding: 20px 16px;
        background: #f8fafc;
        border: 1.5px solid #e2e8f0;
        border-radius: 12px;
        cursor: pointer;
        transition: border-color 0.2s ease, background 0.2s ease, box-shadow 0.2s ease, transform 0.15s ease;
    }

    .susu-type-card:hover {
        border-color: #99f6e4;
        background: #f0fdfa;
        transform: translateY(-1px);
    }

    .susu-type-card:active {
        transform: translateY(0);
    }

    .susu-type-name {
        font-size: 14px;
        font-weight: 600;
        color: #334155;
        margin: 0;
        transition: color 0.2s ease;
    }

    .susu-type-check {
        position: absolute;
        top: 8px;
        right: 8px;
        width: 18px;
        height: 18px;
        border-radius: 50%;
        background: #0f766e;
        color: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transform: scale(0.6);
        transition: opacity 0.2s ease, transform 0.2s ease;
    }

    .susu-type-check svg {
        width: 11px;
        height: 11px;
    }

    .susu-type-card.selected {
        background: #f0fdfa;
        border-color: #0f766e;
        border-width: 2.5px;
        box-shadow: 0 0 0 3px rgba(15, 118, 110, 0.15);
    }

    .susu-type-card.selected .susu-type-name {
        color: #0f766e;
    }

    .susu-type-card.selected .susu-type-check {
        opacity: 1;
        transform: scale(1);
    }

    /* ===== Info Icon and Tooltip ===== */
    .susu-type-info {
        position: absolute;
        top: 8px;
        left: 8px;
        width: 18px;
        height: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: help;
        color: #64748b;
        transition: color 0.2s ease;
    }

    .susu-type-info svg {
        width: 16px;
        height: 16px;
    }

    .susu-type-info:hover {
        color: #0f766e;
    }

    .susu-type-tooltip {
        position: absolute;
        bottom: calc(100% + 8px);
        left: 50%;
        transform: translateX(-50%) translateY(-4px);
        background: #1e293b;
        color: #ffffff;
        font-size: 12px;
        font-weight: 500;
        padding: 8px 12px;
        border-radius: 8px;
        width: 220px;
        text-align: center;
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.2s ease, transform 0.2s ease, visibility 0.2s ease;
        z-index: 10;
        line-height: 1.4;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .susu-type-tooltip::after {
        content: '';
        position: absolute;
        top: 100%;
        left: 50%;
        transform: translateX(-50%);
        border: 6px solid transparent;
        border-top-color: #1e293b;
    }

    .susu-type-info:hover .susu-type-tooltip {
        opacity: 1;
        visibility: visible;
        transform: translateX(-50%) translateY(0);
    }

    @media (max-width: 480px) {
        .susu-type-cards {
            grid-template-columns: 1fr 1fr;
        }

        .susu-type-card {
            padding: 16px 12px;
        }
    }

    /* connecting line */
    .demo-step::before {
        content: '';
        position: absolute;
        top: 15px;
        left: -50%;
        width: 100%;
        height: 3px;
        background: #e2e8f0;
        z-index: 0;
        transition: background 0.4s ease;
    }

    .demo-step:first-child::before {
        display: none;
    }

    /* the dot */
    .demo-step::after {
        content: '';
        position: absolute;
        top: 4px;
        left: 50%;
        transform: translateX(-50%);
        width: 24px;
        height: 24px;
        border-radius: 50%;
        background: #e2e8f0;
        border: 3px solid #ffffff;
        box-shadow: 0 0 0 1px #e2e8f0;
        z-index: 1;
        transition: background 0.3s ease, box-shadow 0.3s ease, transform 0.3s ease;
    }

    .demo-step.active {
        color: #e11d48;
    }

    .demo-step.active::after {
        background: #e11d48;
        box-shadow: 0 0 0 1px #e11d48, 0 0 0 4px rgba(225, 29, 72, 0.15);
        transform: translateX(-50%) scale(1.1);
    }

    .demo-step.active::before {
        background: linear-gradient(to right, #e11d48, #e2e8f0);
    }

    .demo-step.completed {
        color: #16a34a;
    }

    .demo-step.completed::after {
        background: #16a34a;
        box-shadow: 0 0 0 1px #16a34a;
        /* checkmark */
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='white' stroke-width='3' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='20 6 9 17 4 12'%3E%3C/polyline%3E%3C/svg%3E");
        background-size: 12px 12px;
        background-repeat: no-repeat;
        background-position: center;
    }

    .demo-step.completed::before {
        background: #16a34a;
    }

    /* ===== Form Layout ===== */
    .onboard-form-wrapper {
        width: 100%;
    }

    .available-plans-wrapper.as-grid-wrapper {
        display: flex;
        flex-direction: column;
        gap: 10px !important;
    }

    /* ===== Inputs (targets your x-inputs.special.text wrapper) ===== */
    .available-plans-wrapper label,
    .available-plans-wrapper .input-label {
        display: block;
        font-size: 13px;
        font-weight: 600;
        color: #475569;
        margin-bottom: 0px !important;
    }

    .available-plans-wrapper input[type="text"],
    .available-plans-wrapper input[type="email"],
    .available-plans-wrapper input[type="tel"],
    .available-plans-wrapper select {
        width: 100%;
        padding: 13px 16px;
        font-size: 15px;
        color: #1e293b;
        background: #f8fafc;
        border: 1.5px solid #e2e8f0;
        border-radius: 10px;
        outline: none;
        transition: border-color 0.2s ease, background 0.2s ease, box-shadow 0.2s ease;
        box-sizing: border-box;
        margin:0px !important;
    }

    .available-plans-wrapper input[type="text"]:hover,
    .available-plans-wrapper input[type="email"]:hover,
    .available-plans-wrapper input[type="tel"]:hover,
    .available-plans-wrapper select:hover {
        border-color: #cbd5e1;
    }

    .available-plans-wrapper input[type="text"]:focus,
    .available-plans-wrapper input[type="email"]:focus,
    .available-plans-wrapper input[type="tel"]:focus,
    .available-plans-wrapper select:focus {
        background: #ffffff;
        border-color: #0f766e;
        box-shadow: 0 0 0 4px rgba(15, 118, 110, 0.1);
    }

    .available-plans-wrapper select {
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%2364748b' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 14px center;
        background-size: 18px;
        padding-right: 40px;
        cursor: pointer;
    }

    .note {
        font-size: 13px;
        color: #64748b;
        text-align: center;
        margin: -8px 0 4px;
    }

    /* ===== Error State ===== */
    .error.form-error {
        background: #fef2f2;
        border: 1px solid #fecaca;
        color: #dc2626;
        font-size: 11px;
        font-weight: 500;
        padding: 10px 14px;
        border-radius: 8px;
        text-align: center;
        display: inline-block;
    }

    /* ===== CTA Buttons ===== */
    .onboard-cta-wrapper {
        margin-top: 4px;
    }

    .onboard-cta-wrapper.as-relative {
        position: relative;
    }

    .onboard-continue-btn {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        width: 100%;
        background: #0f766e;
        border-radius: 10px;
        cursor: pointer;
        transition: background 0.2s ease, transform 0.15s ease, box-shadow 0.2s ease;
        box-shadow: 0 2px 8px rgba(15, 118, 110, 0.25);
        padding: 14px;
    }

    .onboard-continue-btn:hover {
        background: #0d9488;
        box-shadow: 0 4px 14px rgba(15, 118, 110, 0.32);
        transform: translateY(-1px);
    }

    .onboard-continue-btn:active {
        transform: translateY(0);
    }

    .onboard-continue-btn .btn-standard {
        color: #ffffff;
        font-size: 15px;
        font-weight: 600;
        letter-spacing: 0.02em;
        text-transform: uppercase;
    }

    /* loader tweak */
    .onboard-continue-btn .loader-border.green-loader {
        width: 18px;
        height: 18px;
        border-color: rgba(255, 255, 255, 0.4);
        border-top-color: #ffffff;
    }

    /* ===== Success / Portal Link States ===== */
    .your-portal-alt,
    .your-portal {
        width: 100%;
        text-align: center;
        margin: 24px 0;
        font-size: 16px;
        color: #475569;
    }

    .your-portal-alt p,
    .your-portal p {
        margin-bottom: 12px;
    }

    .demo-link,
    .your-portal b {
        display: inline-block;
        background: #f0fdfa;
        border: 1px solid #99f6e4;
        color: #0f766e;
        font-size: 17px;
        font-weight: 700;
        padding: 12px 24px;
        border-radius: 10px;
        word-break: break-all;
    }

    /* ===== Failed State ===== */
    .available-plans-wrapper p {
        text-align: center;
        color: #475569;
        margin: 4px 0;
    }

    .onboard-cta-wrapper a {
        display: inline-block;
        margin: 0 auto;
        color: #0f766e;
        font-weight: 600;
        text-decoration: underline;
        text-underline-offset: 3px;
    }

    /* ===== WhatsApp CTA ===== */
    .hero-cta {
        margin-top: 32px;
    }

    .btn.btn-whatsapp {
        display: flex !important;
        align-items: center;
        justify-content: center;
        gap: 8px;
        max-width: 280px;
        margin: 0 auto;
        background: #25d366;
        color: #ffffff;
        font-size: 14px;
        font-weight: 600;
        padding: 13px 24px;
        border-radius: 10px;
        text-decoration: none;
        transition: background 0.2s ease, transform 0.15s ease;
        box-shadow: 0 2px 8px rgba(37, 211, 102, 0.3);
    }

    .btn.btn-whatsapp:hover {
        background: #20bd5a;
        transform: translateY(-1px);
    }

    .btn.btn-whatsapp i {
        font-size: 16px;
    }

    /* ===== Utility ===== */
    .as-pointer {
        cursor: pointer;
    }

    .as-center {
        text-align: center;
    }

    .as-relative {
        position: relative;
    }

    [x-cloak] {
        display: none !important;
    }

    .btn-reset {
        background: inherit;
        border: none;
        text-decoration: none;
        appearance: none;
        font-family: sans-serif;
        -webkit-appearance: none;
        -moz-appearance: none;
        display: block;
        width: 100%;
        padding: 15px 20px;
        border-radius: 10px;
    }

    /* ===== Responsive ===== */
    @media (max-width: 600px) {
        .actual-steps-wrapper {
            padding: 28px 20px;
            border-radius: 12px;
        }

        .onboard-hero-text {
            font-size: 22px;
            margin-bottom: 24px;
        }

        .demo-step {
            font-size: 11px;
            padding-top: 38px;
        }

        .onboard-step-wrapper {
            margin: 30px auto;
        }
    }
</style>
</div>
