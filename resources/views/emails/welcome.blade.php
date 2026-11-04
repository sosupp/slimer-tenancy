<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to SUSU CRM</title>
    <style>
        :root {
            --primary-light: #ecf8e5;
            --primary-dark: #347571;
            --secondary: #2a5e5a;
            --accent: #f4b400;
            --text-dark: #1a2a27;
            --text-light: #5a726f;
            --white: #ffffff;
            --shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            --transition: all 0.3s ease;
        }
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background: linear-gradient(135deg, #ecf8e5 0%, #d4edda 100%);
            color: #347571;
            padding: 40px 20px;
            text-align: center;
            border-radius: 10px 10px 0 0;
        }
        .header h1 {
            margin: 0;
            font-size: 32px;
            font-weight: 600;
        }
        .content {
            background: #ffffff;
            padding: 40px 30px;
            border: 1px solid #e9ecef;
            border-top: none;
            border-radius: 0 0 10px 10px;
        }
        .button {
            display: inline-block;
            padding: 12px 30px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white !important;
            text-decoration: none;
            border-radius: 25px;
            font-weight: 600;
            margin: 20px 0;
            transition: transform 0.2s;
        }
        .button:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }
        .feature-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin: 30px 0;
        }
        .feature-item {
            padding: 20px;
            background: #f8f9fa;
            border-radius: 10px;
            text-align: center;
        }
        .feature-icon {
            font-size: 32px;
            margin-bottom: 10px;
        }
        .quick-links {
            background: #f1f3f5;
            padding: 20px;
            border-radius: 10px;
            margin: 30px 0;
        }
        .quick-links a {
            color: #667eea;
            text-decoration: none;
            display: block;
            margin: 10px 0;
        }
        .stats-highlight {
            display: flex;
            justify-content: space-around;
            margin: 30px 0;
            padding: 20px;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-radius: 10px;
        }
        .stat-item {
            text-align: center;
        }
        .stat-number {
            font-size: 24px;
            font-weight: bold;
            color: #764ba2;
            display: block;
        }
        .stat-label {
            font-size: 12px;
            color: #666;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .footer {
            text-align: center;
            padding: 20px;
            color: #666;
            font-size: 14px;
        }
        .social-links {
            margin: 20px 0;
        }
        .social-links a {
            display: inline-block;
            margin: 0 10px;
            color: #667eea;
            text-decoration: none;
        }
        @media only screen and (max-width: 600px) {
            .feature-grid {
                grid-template-columns: 1fr;
            }
            .container {
                padding: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🚀 Welcome to SUSU CRM!</h1>
            <p style="font-size: 18px; margin-top: 10px;">Build trust, growth and proper management.</p>
        </div>

        <div class="content">
            <p style="font-size: 18px;">Hi <strong>{{ $userName }}</strong>,</p>

            <p>We're thrilled to have you on board! You've just taken the first step toward transforming your susu venture with proper records tracking, accounting and automation.</p>

            @if($businessName)
            <div style="background: #e8f5e9; padding: 15px; border-radius: 8px; margin: 20px 0;text-align: center;">
                <p style="margin: 0; color: #2e7d32;"><strong>You registered as the Onwer of</strong></p>
                <p style="margin: 10px 0 0 0; font-size: 14px;text-transform:uppercase">{{ $businessName }}</p>
            </div>
            @endif

            <div style="text-align: center;">
                <a href="{{ $loginUrl }}" class="button">🎯 Log In to Your Portal</a>
                <p style="margin: 0;font-size: 14px;">Or copy and paste in a web browser: <strong>{{$loginUrl}}</strong></p>
            </div>

            <!-- Stats Highlight - Social Proof -->
            <div class="stats-highlight">
                {{-- <div class="stat-item">
                    <span class="stat-number">10,000+</span>
                    <span class="stat-label">Active Users</span>
                </div> --}}
                <div class="stat-item">
                    <span class="stat-number"> GHc 3.5M+</span>
                    <span class="stat-label">Transactions</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">97%</span>
                    <span class="stat-label">Reduced Disputes for owners</span>
                </div>
            </div>

            <h2 style="text-align: center; margin: 40px 0 20px;">✨ What You Can Do With SUSU CRM</h2>

            <div class="feature-grid">
                <div class="feature-item">
                    <div class="feature-icon">💵</div>
                    <h3 style="margin: 10px 0;">Instant Records</h3>
                    <p style="color: #666;">Records payments in seconds - no paper needed. Daily Contributions & Tracking.</p>
                </div>

                <div class="feature-item">
                    <div class="feature-icon">📂</div>
                    <h3 style="margin: 10px 0;">Member Accounts</h3>
                    <p style="color: #666;">Add, edit and track members or accounts easily with their complete profile & payment history.</p>
                </div>

                <div class="feature-item">
                    <div class="feature-icon">👥</div>
                    <h3 style="margin: 10px 0;">Empower Your Team</h3>
                    <p style="color: #666;">If you have a team - grant access, track performance & real time accountability.</p>
                </div>

                <div class="feature-item">
                    <div class="feature-icon">📊</div>
                    <h3 style="margin: 10px 0;">Smart Reports</h3>
                    <p style="color: #666;">See daily, weekly, monthly performance and make data-driven decisions</p>
                </div>

                <div class="feature-item">
                    <div class="feature-icon">📧</div>
                    <h3 style="margin: 10px 0;">PDF/ Excel Exports</h3>
                    <p style="color: #666;">Share reports with members or auditors or for your own usage.</p>
                </div>

                <div class="feature-item">
                    <div class="feature-icon">📈</div>
                    <h3 style="margin: 10px 0;">Accounting</h3>
                    <p style="color: #666;">The system automates your business finances - revenue, profit & loss, cash flow, etc.</p>
                </div>
            </div>

            <!-- Quick Start Guide -->
            <div class="quick-links">
                <h3 style="margin-top: 0;">🚀 Quick Start Checklist:</h3>
                <a href="{{ $setupGuideUrl }}">✅ Complete your unique portal setup</a>
                <a href="#">✅ Add or Import your first members or accounts</a>
                <a href="#">✅ Make your first transaction</a>
                {{-- <a href="{{ $webinarUrl }}">✅ Watch our 5-min getting started video</a>
                <a href="{{ $knowledgeBaseUrl }}">✅ Explore knowledge base tutorials</a> --}}
            </div>

            <!-- Pro Tips -->
            <div style="background: #fff3e0; padding: 20px; border-radius: 10px; margin: 30px 0;">
                <h3 style="margin-top: 0; color: #e65100;">💡 Pro Tip</h3>
                <p style="margin: 0;">Take about 5 minutes to complete setup for your unique portal and start transacting and you will begin to see the value. <strong>You are automatically on the forever free plan. So enjoy!</strong></p>
            </div>

            <!-- Support Section -->
            <div style="border-top: 1px solid #e9ecef; margin: 30px 0; padding-top: 30px;">
                <p style="text-align: center;">Need help getting started? Our customer success team is here for you!</p>
                <div style="text-align: center;display: flex;align-items: center;gap: 10px;justify-content: center;">
                    <a href="https://wa.me/233545044139" target="_blank" class="btn btn-whatsapp">
                        <svg xmlns="http://www.w3.org/2000/svg" aria-label="WhatsApp" role="img" viewBox="0 0 512 512" width="16px" height="16px" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><rect width="512" height="512" rx="15%" fill="#25d366"></rect><path fill="#25d366" stroke="#ffffff" stroke-width="26" d="M123 393l14-65a138 138 0 1150 47z"></path><path fill="#ffffff" d="M308 273c-3-2-6-3-9 1l-12 16c-3 2-5 3-9 1-15-8-36-17-54-47-1-4 1-6 3-8l9-14c2-2 1-4 0-6l-12-29c-3-8-6-7-9-7h-8c-2 0-6 1-10 5-22 22-13 53 3 73 3 4 23 40 66 59 32 14 39 12 48 10 11-1 22-10 27-19 1-3 6-16 2-18"></path></g></svg> WhatsApp
                    </a>
                    <a href="mailto:{{ $supportEmail }}" style="color: #667eea; margin-right: 20px;">📧 {{ $supportEmail }}</a>
                    <a href="{{ $knowledgeBaseUrl }}" style="color: #667eea;">📚 Knowledge Base</a>
                </div>
            </div>

            <!-- Social Proof Testimonial -->
            <div style="background: #f3e5f5; padding: 20px; border-radius: 10px; margin: 30px 0; text-align: center;">
                <p style="font-style: italic; margin: 0;">"Since switching from manual records to Susu CRM especially with the automation & SMS our membership grew by 150%. We built more transparency with out members."</p>
                <p style="margin: 10px 0 0;"><strong>- Zabzior SUSU Enterprise</strong></p>
            </div>
        </div>

        <div class="footer">
            <div class="social-links">
                <a href="#">Twitter</a> •
                <a href="#">LinkedIn</a> •
                <a href="#">Facebook</a> •
                <a href="#">YouTube</a>
            </div>
            <p>© {{ date('Y') }} SUSU CRM. All rights reserved.</p>
            <p style="font-size: 12px;">
                <a href="#">Privacy Policy</a> |
                <a href="#">Terms of Service</a> |
                <a href="#">Unsubscribe</a>
            </p>
            <p style="font-size: 12px; color: #999;">
                You're receiving this email because you created an account with SUSU CRM.
            </p>
        </div>
    </div>
</body>
</html>
