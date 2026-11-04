<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SUSU CRM Account</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
            background-color: #f4f7fc;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }
        .header {
            background: linear-gradient(135deg, #ecf8e5 0%, #d4edda 100%);;
            color: #347571;
            padding: 30px 20px;
            text-align: center;
            position: relative;
        }
        .header h1 {
            margin: 0;
            font-size: 28px;
            font-weight: 700;
        }
        .header .subtitle {
            font-size: 16px;
            opacity: 0.9;
            margin-top: 10px;
        }
        .urgency-badge {
            background: #ff6b35;
            color: white;
            padding: 8px 16px;
            border-radius: 50px;
            display: inline-block;
            font-weight: 600;
            font-size: 14px;
            margin-bottom: 15px;
        }
        .content {
            padding: 40px 30px;
        }
        .warning-box {
            background: #fff3e0;
            border-left: 4px solid #ff6b35;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
        }
        .stats-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin: 25px 0;
        }
        .stat-card {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 12px;
            text-align: center;
            border: 1px solid #e9ecef;
        }
        .stat-value {
            font-size: 28px;
            font-weight: 700;
            color: #1a4d2e;
            display: block;
            line-height: 1.2;
        }
        .stat-label {
            font-size: 13px;
            color: #666;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .progress-section {
            background: #f1f8e9;
            padding: 25px;
            border-radius: 12px;
            margin: 30px 0;
        }
        .progress-bar {
            height: 10px;
            background: #e0e0e0;
            border-radius: 5px;
            overflow: hidden;
            margin: 15px 0;
        }
        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #1a4d2e, #2e7d32);
            width: {{ $completionPercentage }}%;
            border-radius: 5px;
        }
        .setup-steps {
            margin: 30px 0;
        }
        .step-item {
            display: flex;
            align-items: center;
            padding: 12px;
            border-bottom: 1px solid #e9ecef;
        }
        .step-item:last-child {
            border-bottom: none;
        }
        .step-icon {
            width: 30px;
            height: 30px;
            background: #f0f0f0;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            font-size: 16px;
        }
        .step-content {
            flex: 1;
        }
        .step-time {
            font-size: 12px;
            color: #666;
            background: #f0f0f0;
            padding: 3px 8px;
            border-radius: 12px;
        }
        .button-primary {
            display: block;
            padding: 16px 24px;
            background: linear-gradient(135deg, #1a4d2e, #2e7d32);
            color: white !important;
            text-decoration: none;
            border-radius: 50px;
            font-weight: 600;
            font-size: 18px;
            text-align: center;
            margin: 30px 0;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .button-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(26, 77, 46, 0.3);
        }
        .button-secondary {
            display: inline-block;
            padding: 12px 24px;
            background: white;
            color: #1a4d2e !important;
            text-decoration: none;
            border-radius: 50px;
            font-weight: 600;
            border: 2px solid #1a4d2e;
            margin: 10px 5px;
        }
        .testimonial {
            background: #f8f9fa;
            padding: 25px;
            border-radius: 12px;
            margin: 30px 0;
            font-style: italic;
            border: 1px solid #e9ecef;
        }
        .testimonial-author {
            display: flex;
            align-items: center;
            margin-top: 15px;
        }
        .author-avatar {
            width: 40px;
            height: 40px;
            background: #1a4d2e;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            margin-right: 10px;
        }
        .whatsapp-button {
            background: #25D366;
            color: white;
            padding: 12px 20px;
            border-radius: 50px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            margin: 10px 0;
        }
        .footer {
            background: #f8f9fa;
            padding: 30px;
            text-align: center;
            color: #666;
            font-size: 14px;
            border-top: 1px solid #e9ecef;
        }
        .savings-alert {
            background: #ff6b35;
            color: white;
            padding: 15px;
            border-radius: 8px;
            text-align: center;
            font-weight: 600;
            margin: 20px 0;
        }
        @media only screen and (max-width: 600px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }
            .container {
                margin: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Complete Your SUSU CRM free Account</h1>
            <div class="subtitle">Stop losing money, records & trust - A step closer to growth!</div>
        </div>

        <div class="content">
            <p style="font-size: 18px;">Hi, <strong>{{ $owner }}</strong>! 👋</p>

            <p>Your free account is waiting! When you finish creating your free account you will have access to your <strong>SUSU CRM Unique Portal</strong> to enhance your venture.</p>

            <p>What worries many susu vendors or groups include:</p>

            <div class="warning-box">
                <ul style="margin: 0; padding-left: 20px;">
                    <li><strong>❌ Losing track of contributions</strong> - Manual records get lost or damaged</li>
                    <li><strong>💰 Missing suspicious transactions</strong> - No SMS alerts for members</li>
                    <li><strong>🤝 Damaging trust</strong> - Members lose confidence in record-keeping</li>
                    <li><strong>📉 Wasting time</strong> - Hours spent calculating instead of growing</li>
                </ul>
            </div>

            <!-- Main CTA -->
            <a href="{{ $demoLink }}" class="button-primary"
                style="display: block;padding: 16px 24px;background: linear-gradient(135deg, #1a4d2e, #2e7d32);color: white !important;text-decoration: none;border-radius: 50px;font-weight: 600;font-size: 18px;text-align: center;margin: 30px 0;transition: transform 0.2s, box-shadow 0.2s;">
                🚀 Finish Account Signup (Takes 2 Mins)
            </a>

            <!-- Social Proof - Local Success Story -->
            <div class="testimonial">
                <p>"I was losing track of my 30-member susu group every month. With SUSU CRM, I now have real-time records and members get SMS confirmations. No more 'I forgot' excuses!"</p>
                <div class="testimonial-author">
                    <div>
                        <strong>Abena Mensah</strong><br>
                        <span style="font-size: 13px; color: #666;">Susu Vendor, Makola Market</span>
                    </div>
                </div>
            </div>

            <!-- Special Offer/Urgency -->
            <div class="savings-alert">
                ⚡ No Time Limits. Enjoy the forever free plan.!
            </div>

            <!-- Benefits Highlight -->
            <div style="margin: 30px 0;">
                <h3>What you're missing right now:</h3>

                <div style="margin: 15px 0;">
                    <p><strong>📱 SMS Notifications</strong> - Members get instant alerts when you record their contribution</p>
                    <p><strong>📊 Daily Collection Reports</strong> - Know exactly how much came in, anytime</p>
                    <p><strong>🔒 Digital Records</strong> - Never lose another notebook or ledger</p>
                    <p><strong>🤝 Member Trust</strong> - Share reports to prove every pesewa is accounted for</p>
                </div>
            </div>

            <!-- WhatsApp Support - Crucial for Ghana market -->
            <div style="background: #e8f5e9; padding: 20px; border-radius: 12px; text-align: center; margin: 30px 0;">
                <h3 style="margin-top: 0;">Need help setting up?</h3>
                <p>🇬🇭 Chat with us on WhatsApp for instant support in Twi, Ewe, Ga, or English</p>
                <a href="https://wa.me/{{ supportPhone() }}" class="whatsapp-button" target="_blank">
                    📱 Message us on WhatsApp
                </a>
                <p style="margin: 10px 0 0; font-size: 14px;">Or call: {{ supportPhone() }}</p>
            </div>

            <!-- Alternative CTAs -->
            <div style="text-align: center; margin: 20px 0;">
                <a href="{{ $demoLink }}" class="button-secondary">👀 Watch 2-min Setup</a>
                <a href="{{ $guidebookUrl }}" class="button-secondary">📚 Download Guide</a>
            </div>

            <!-- Quick Tips -->
            <div style="background: #f1f8e9; padding: 15px; border-radius: 8px; margin: 20px 0;">
                <p style="margin: 0; font-size: 14px;"><strong>💡 Pro Tip:</strong> With SUSU CRM you have many tools including your business financials automated - P&L, cash flow, etc.</p>
            </div>

            <a href="{{ $demoLink }}" class="button-primary" style="display: block;padding: 16px 24px;background: linear-gradient(135deg, #1a4d2e, #2e7d32);color: white !important;text-decoration: none;border-radius: 50px;font-weight: 600;font-size: 18px;text-align: center;margin: 30px 0;transition: transform 0.2s, box-shadow 0.2s;">
                🚀 Complete Free Account (Takes 2 Mins)
        </a>
        </div>

        <div class="footer">
            <p><strong>SUSU CRM</strong> - Ghana's #1 Digital Susu Management System</p>
            <p>📍 Accra, Ghana | 📞 {{ supportPhone() }} | 📧 {{ supportEmail() }}</p>

            <div style="margin: 20px 0;">
                <a href="#" style="color: #1a4d2e; margin: 0 10px;">Facebook</a> |
                <a href="#" style="color: #1a4d2e; margin: 0 10px;">WhatsApp</a> |
                <a href="#" style="color: #1a4d2e; margin: 0 10px;">Instagram</a>
            </div>

            <p style="font-size: 12px; color: #999;">
                You received this email because you started registering on SUSU CRM.<br>
                <a href="#" style="color: #666;">Complete setup now</a> or
                <a href="#" style="color: #666;">unsubscribe</a> if you're not interested.
            </p>
        </div>
    </div>
</body>
</html>
