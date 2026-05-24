@extends('layouts.app')

@section('content')
    {{-- hero --}}
    <x-site.landing-hero />

    {{-- highlight --}}
    <x-site.page-section
        sectionTitle="accounts management">
        <x-slot:content>
            <div class="two-col">

                {{-- image --}}
                <div class="section-image">
                    <img src="{{asset('standard/susu-img-3.svg')}}"
                        alt="SUSU-CRM Ghana">
                </div>

                {{-- text --}}
                <div class="section-text">
                    <p>
                        <span>Manage new & existing customers'</span>
                        <br> profiles with trust using in-built
                        <br> SMS for every transaction.
                    </p>

                    <p>
                        <span>Manage employees, agents</span>
                        and give access
                        <br> to your mobile bankers. And track
                        <br> their work and performance.
                    </p>

                    <div class="section-cta">

                    </div>
                </div>
            </div>
        </x-slot:content>
    </x-site.page-section>

    {{-- core features --}}
    <x-site.page-section
        bgColor="section-bg"
        sectionTitle="Core Features"
        id="features">

        <x-slot:content>
            <div class="three-col">
                <div class="core-features">
                    <h3>transaction notifications</h3>
                    <p>SMS, Email, and dashboard notifications for both business and customers.</p>
                </div>

                <div class="core-features">
                    <h3>automated financial statements</h3>
                    <p>
                        Income (P & L) Statement,
                        cash flow,
                        Balance Sheet, etc.
                    </p>
                </div>

                <div class="core-features">
                    <h3>automated business report & analysis</h3>
                    <p>
                        Transactions,
                        Deposits,
                        Withdrawals,
                        Customers,
                        etc.
                    </p>
                </div>

                <div class="core-features">
                    <h3>Data exports</h3>
                    <p>
                        Automatic or manual PDF or EXCEL exports of relevant reports and data.
                    </p>
                </div>

                <div class="core-features">
                    <h3>Data Backups</h3>
                    <p>
                        Regular Automatic data backup for emergency cases.
                    </p>

                    <p>
                        Backup data are exported to your business email weekly.
                    </p>
                </div>

                <div class="core-features">
                    <h3>Customer & Employee Management</h3>
                    <p>
                        Unlimited customer accounts and control.
                    </p>

                    <p>
                        Give restricted access to employees or mobile bankers.
                    </p>
                </div>

            </div>
        </x-slot:content>
    </x-site.page-section>

    {{-- why use --}}
    <x-site.page-section
        sectionTitle="Why Use SUSU-CRM">

        <x-slot:content>
            <div class="two-col">
                <div class="why-use-image">
                    <img src="{{asset('standard/susu-img-4.svg')}}"
                    alt="SUSU-CRM Ghana">
                </div>

                <div class="section-text">
                    <ul>
                        <li>

                            Affordable and valuable
                        </li>


                        <li>
                            Automated</li>
                        <li>
                            Secured business data</li>
                        <li>
                            Financial reports</li>
                        <li>
                            Regular updates and new features</li>
                        <li>
                            24/7 after on-boarding support</li>
                    </ul>

                    <x-util.link-button
                        linkUrl="#contactUs"
                        label="Start 7 days trial"
                        styles="trial-button"
                    />
                </div>
            </div>
        </x-slot:content>

    </x-site.page-section>

    {{-- pricing --}}
    <x-site.page-section
        sectionTitle="Affordable Pricing"
            id="pricingWrapper">

        <x-slot:content>
            <div class="pricing-main-wrapper">


                <div class="section-text">
                    <p>Pricing that understands your finanical demands as SME and yet gives you an excellent business management software.</p>

                    <div class="pricing-container">
                        <!-- Package 1 -->
                        <div class="price-card">
                            <div class="price-header">Starter</div>
                            <div class="price">GHc 120</div>
                            <div class="per-month">per month</div>
                            <div class="per-year">GHc 1440 per year</div>

                            <div class="included-heading">What is included?</div>
                            <div class="whats-included-list">
                                <div class="included-list-item">
                                    <span>+</span>
                                    <span>100 customers</span>
                                </div>
                                <div class="included-list-item">
                                    <span>+</span>
                                    <span>1 branch</span>
                                </div>
                                <div class="included-list-item">
                                    <span>+</span>
                                    <span>300 free sms (per month)</span>
                                </div>
                                <div class="included-list-item">
                                    <span>+</span>
                                    <span>Unlimited staff/agent</span>
                                </div>
                                <div class="included-list-item">
                                    <span>+</span>
                                    <span><a href="#features">All core features</a></span>
                                </div>
                            </div>
                        </div>
                        <!-- Package 2 -->
                        <div class="price-card">
                            <div class="price-header">Basic</div>
                            <div class="price">GHc 250</div>
                            <div class="per-month">per month</div>
                            <div class="per-year">GHc 2700 per year</div>
                            <div class="save">Save 10%</div>

                            <div class="included-heading">What is included?</div>
                            <div class="whats-included-list">
                                <div class="included-list-item">
                                    <span>+</span>
                                    <span>250 customers</span>
                                </div>
                                <div class="included-list-item">
                                    <span>+</span>
                                    <span>2 branches</span>
                                </div>
                                <div class="included-list-item">
                                    <span>+</span>
                                    <span>400 free sms (per month)</span>
                                </div>
                                <div class="included-list-item">
                                    <span>+</span>
                                    <span>100 emails (per month)</span>
                                </div>
                                <div class="included-list-item">
                                    <span>+</span>
                                    <span>Unlimited staff/agent</span>
                                </div>
                                <div class="included-list-item">
                                    <span>+</span>
                                    <span><a href="#features">All core features</a></span>
                                </div>
                            </div>
                        </div>

                        <!-- Package 3 (Recommended) -->
                        <div class="price-card recommended">
                            <div class="price-header">Pro</div>
                            <div class="price">GHc 350</div>
                            <div class="per-month">per month</div>
                            <div class="per-year">GHc 4200 per year</div>
                            <div class="save">Save 12.5%</div>

                            <div class="included-heading">What is included?</div>
                            <div class="whats-included-list">
                                <div class="included-list-item">
                                    <span>+</span>
                                    <span>500 customers</span>
                                </div>
                                <div class="included-list-item">
                                    <span>+</span>
                                    <span>3 branches</span>
                                </div>
                                <div class="included-list-item">
                                    <span>+</span>
                                    <span>600 free sms (per month)</span>
                                </div>
                                <div class="included-list-item">
                                    <span>+</span>
                                    <span>100 emails (per month)</span>
                                </div>
                                <div class="included-list-item">
                                    <span>+</span>
                                    <span>Unlimited staff/agent</span>
                                </div>
                                <div class="included-list-item">
                                    <span>+</span>
                                    <span><a href="#features">All core features</a></span>
                                </div>
                            </div>
                        </div>

                        <!-- Package 4 -->
                        <div class="price-card">
                            <div class="price-header">Enterprise</div>
                            <div class="price">GHc 600</div>
                            <div class="per-month">per month</div>
                            <div class="per-year">GHc 6000 per year</div>
                            <div class="save">Save 16.7%</div>

                            <div class="included-heading">What is included?</div>
                            <div class="whats-included-list">
                                <div class="included-list-item">
                                    <span>+</span>
                                    <span>Unlimited customers</span>
                                </div>
                                <div class="included-list-item">
                                    <span>+</span>
                                    <span>Unlimited branches</span>
                                </div>
                                <div class="included-list-item">
                                    <span>+</span>
                                    <span>1000 free sms (per month)</span>
                                </div>
                                <div class="included-list-item">
                                    <span>+</span>
                                    <span>100 emails (per month)</span>
                                </div>
                                <div class="included-list-item">
                                    <span>+</span>
                                    <span>Unlimited staff/agent</span>
                                </div>
                                <div class="included-list-item">
                                    <span>+</span>
                                    <span><a href="#features">All core features</a></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <x-util.link-button
                        linkUrl="#contactUs"
                        label="Start 7 days trial"
                        styles="trial-button"
                    />
                </div>
            </div>
        </x-slot:content>

    </x-site.page-section>

    {{-- speak to us --}}
    <x-site.page-section
        sectionTitle="Speak to us"
        bgColor="speak-to-us-wrapper"
        id="contactUs">

        <x-slot:content>
            <div class="section-heading">
                <p>An excellent team. Our sales engineers are always available to answer
                    your questions and get your business unto SUSU-CRM</p>
            </div>

            <div class="two-col speak-to-us">
                <div class="rep-image">
                    <img src="{{asset('standard/bless-rep.svg')}}" alt="SUSU-CRM">
                </div>

                <div class="section-text rep-detail">
                    <p>
                        Bless Matey
                        <br>
                        <span>Senior sales Engineer</span>
                    </p>

                    <p>
                        (233) 57 998 6797
                    </p>

                    <p>
                        sales@susu-crm.com
                        <br>
                        info@lyn-apps.com
                    </p>

                    <div class="whatsapp">
                        <x-util.link-button
                            linkUrl="https://wa.me/233579986797"
                            label="WhatsApp Us"
                            styles="whatsapp-link"
                        />
                    </div>
                </div>
            </div>

            <div class="two-col speak-to-us">
                <div class="rep-image">
                    <img src="{{asset('standard/ike-rep.svg')}}" alt="SUSU-CRM">
                </div>

                <div class="section-text rep-detail">
                    <p>
                        Isaac Koranteng
                        <br>
                        <span>Senior sales Engineer</span>
                    </p>

                    <p>
                        (233) 54 019 8112
                    </p>

                    <p>
                        sales@susu-crm.com
                        <br>
                        info@lyn-apps.com
                    </p>

                    <div class="whatsapp">
                        <x-util.link-button
                            linkUrl="https://wa.me/233540198112"
                            label="WhatsApp Us"
                            styles="whatsapp-link"
                        />
                    </div>
                </div>
            </div>
        </x-slot:content>


    </x-site.page-section>

    <x-site.page-section
        sectionTitle="About Us">

        <x-slot:content>
            <div class="two-col">
                <div class="rep-image">
                    <img src="{{asset('standard/lyn-apps.svg')}}" alt="lyn-apps">
                </div>

                <div class="section-text about-us-text">
                    <p> <span>SUSU-CRM</span> is developed and managed by LynApps Limited. LynApps is a registered software development company in Ghana since 2017.
                    </p>

                    <p>We develop all kinds of web and mobile applications, with the goal of truly revealing the benefits of a digitalized economy.
                    </p>

                    <p>Find out more about LynApps by visiting our company's website.
                    </p>

                    <x-util.link-button
                        linkUrl="https://lyn-apps.com"
                        label="READ MORE"
                        styles="outline-link"
                    />
                </div>
            </div>
        </x-slot:content>

    </x-site.page-section>
    {{-- footer --}}
@endsection
