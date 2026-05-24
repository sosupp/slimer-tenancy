<div x-data="accordion()">

    <div class="accordion-wrapper">
        <div class="accordion-cta-wrapper justify-inline-wrapper as-pointer"
            x-on:click="toggle('plans')">
            <div>
                <p class="heading">Current Plan</p>
            </div>

            <div class="as-pointer">
                <x-icons.chevron-down fill="#000" />
            </div>
        </div>

        <div class="accordion-item profile-bio-items" x-cloak x-show="toggleKey == 'plans'">
            {!! $this->planForm() !!}
        </div>
    </div>

    <div class="accordion-wrapper">
        <div class="accordion-cta-wrapper justify-inline-wrapper as-pointer"
            x-on:click="toggle('general-setting')">
            <div>
                <p class="heading">General</p>
            </div>

            <div class="as-pointer">
                <x-icons.chevron-down fill="#000" />
            </div>
        </div>

        <div class="accordion-item profile-bio-items" x-cloak x-show="toggleKey == 'general-setting'">
            {!! $this->generalForm() !!}
        </div>
    </div>


    <div class="accordion-wrapper">
        <div class="accordion-cta-wrapper justify-inline-wrapper as-pointer"
            x-on:click="toggle('notifications')">
            <div>
                <p class="heading">Notifications</p>
            </div>

            <div class="as-pointer">
                <x-icons.chevron-down fill="#000" />
            </div>
        </div>

        <div class="accordion-item profile-bio-items" x-cloak x-show="toggleKey == 'notifications'">
            {!! $this->notificationForm() !!}
        </div>
    </div>


    <div class="accordion-wrapper">
        <div class="accordion-cta-wrapper justify-inline-wrapper as-pointer"
            x-on:click="toggle('money')">
            <div>
                <p class="heading">money</p>
            </div>

            <div class="as-pointer">
                <x-icons.chevron-down fill="#000" />
            </div>
        </div>

        <div class="accordion-item profile-bio-items" x-cloak x-show="toggleKey == 'money'">
            {!! $this->moneyForm() !!}
        </div>
    </div>




</div>
