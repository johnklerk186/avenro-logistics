<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shipment Update - Avenro Logistics</title>
    <style>
        body {
            font-family: 'Open Sans', 'Segoe UI', Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            color: #2D3748;
        }
        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #FFFFFF;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .email-header {
            background: linear-gradient(135deg, #0F2B4D 0%, #1B4470 100%);
            padding: 40px 30px;
            text-align: center;
        }
        .email-header h1 {
            color: #FFFFFF;
            font-family: 'Pathway Gothic One', Arial, sans-serif;
            font-size: 28px;
            margin: 0 0 10px 0;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .email-header p {
            color: #FFFFFF;
            margin: 0;
            font-size: 16px;
        }
        .email-body {
            padding: 40px 30px;
        }
        .greeting {
            font-size: 18px;
            color: #2D3748;
            margin-bottom: 20px;
        }
        .message {
            font-size: 16px;
            line-height: 1.6;
            color: #4A5568;
            margin-bottom: 30px;
        }
        .update-alert {
            background: linear-gradient(135deg, #F4F6F9 0%, #F1F4F9 100%);
            border-left: 4px solid #0F2B4D;
            border-radius: 8px;
            padding: 20px;
            margin: 25px 0;
        }
        .update-alert h3 {
            color: #0F2B4D;
            font-family: 'Pathway Gothic One', Arial, sans-serif;
            font-size: 18px;
            margin: 0 0 10px 0;
            text-transform: uppercase;
        }
        .update-alert p {
            color: #2D3748;
            margin: 5px 0;
            font-size: 15px;
        }
        .tracking-box {
            background-color: #F4F6F9;
            border: 2px solid #0F2B4D;
            border-radius: 8px;
            padding: 20px;
            margin: 30px 0;
            text-align: center;
        }
        .tracking-label {
            font-size: 12px;
            color: #718096;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 8px;
        }
        .tracking-number {
            font-size: 24px;
            font-weight: 700;
            color: #0F2B4D;
            font-family: 'Courier New', monospace;
            letter-spacing: 2px;
        }
        .info-section {
            margin: 30px 0;
        }
        .info-row {
            display: table;
            width: 100%;
            margin-bottom: 15px;
        }
        .info-label {
            display: table-cell;
            width: 40%;
            font-weight: 600;
            color: #2D3748;
            padding: 8px 0;
        }
        .info-value {
            display: table-cell;
            width: 60%;
            color: #4A5568;
            padding: 8px 0;
        }
        .divider {
            height: 1px;
            background-color: #E2E8F0;
            margin: 25px 0;
        }
        .cta-button {
            display: inline-block;
            background-color: #0F2B4D;
            color: #FFFFFF !important;
            text-decoration: none;
            padding: 15px 40px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 16px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin: 20px 0;
            transition: background-color 0.3s;
        }
        .cta-button:hover {
            background-color: #0A1F3D;
        }
        .button-container {
            text-align: center;
            margin: 30px 0;
        }
        .tracking-link {
            color: #0F2B4D;
            text-decoration: none;
            word-break: break-all;
            font-size: 14px;
        }
        .email-footer {
            background-color: #2D3748;
            padding: 30px;
            text-align: center;
            color: #FFFFFF;
        }
        .email-footer p {
            margin: 5px 0;
            font-size: 14px;
            color: #E2E8F0;
        }
        .email-footer a {
            color: #0F2B4D;
            text-decoration: none;
        }
        .status-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 4px;
            font-size: 14px;
            font-weight: 600;
            text-transform: uppercase;
        }
        .status-in-transit {
            background-color: #EBF8FF;
            color: #2C5282;
        }
        .status-delivered {
            background-color: #F0FFF4;
            color: #276749;
        }
        .status-pending {
            background-color: #F4F6F9;
            color: #0F2B4D;
        }
        .status-out-for-delivery {
            background-color: #FEFCBF;
            color: #744210;
        }
        .location-icon {
            display: inline-block;
            width: 20px;
            height: 20px;
            background-color: #0F2B4D;
            border-radius: 50%;
            margin-right: 8px;
            vertical-align: middle;
        }
        .timeline-item {
            padding: 15px;
            background-color: #F7FAFC;
            border-radius: 6px;
            margin-bottom: 10px;
            border-left: 3px solid #0F2B4D;
        }
        .timeline-time {
            font-size: 12px;
            color: #718096;
            margin-bottom: 5px;
        }
        .timeline-desc {
            color: #2D3748;
            font-size: 14px;
        }
        @media only screen and (max-width: 600px) {
            .email-body {
                padding: 30px 20px;
            }
            .tracking-number {
                font-size: 20px;
            }
            .info-row {
                display: block;
            }
            .info-label, .info-value {
                display: block;
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header -->
        <div class="email-header">
            <h1>Avenro Logistics</h1>
            <p>Shipment Update Notification</p>
        </div>

        <!-- Body -->
        <div class="email-body">
            <p class="greeting">Dear {{ $shipment->receiver_name }},</p>

            <p class="message">
                We have an update regarding your shipment. Your package is on its way and we wanted to keep you informed of its progress.
            </p>

            <!-- Update Alert -->
            <div class="update-alert">
                <h3>📦 Latest Update</h3>
                <p><strong>Status:</strong> <span class="status-badge status-{{ strtolower(str_replace(' ', '-', $update->status ?? $shipment->status)) }}">{{ ucwords(str_replace('_', ' ', $update->status ?? $shipment->status)) }}</span></p>
                @if($update->location)
                <p><strong>Location:</strong> <span class="location-icon"></span>{{ $update->location }}</p>
                @endif
                @if($update->description)
                <p><strong>Details:</strong> {{ $update->description }}</p>
                @endif
                <p><strong>Updated:</strong> {{ $update->created_at->format('F d, Y \a\t g:i A') }}</p>
            </div>

            <!-- Tracking Number Box -->
            <div class="tracking-box">
                <div class="tracking-label">Tracking Number</div>
                <div class="tracking-number">{{ $shipment->tracking_number }}</div>
            </div>

            <!-- Current Shipment Status -->
            <div class="info-section">
                <h3 style="color: #2D3748; font-family: 'Pathway Gothic One', Arial, sans-serif; font-size: 20px; margin-bottom: 20px;">
                    Current Shipment Status
                </h3>

                <div class="info-row">
                    <div class="info-label">Status:</div>
                    <div class="info-value">
                        <span class="status-badge status-{{ strtolower(str_replace(' ', '-', $shipment->status)) }}">{{ ucwords(str_replace('_', ' ', $shipment->status)) }}</span>
                    </div>
                </div>

                <div class="info-row">
                    <div class="info-label">Current Location:</div>
                    <div class="info-value">{{ $shipment->current_location ?? $update->location ?? 'In Transit' }}</div>
                </div>

                <div class="info-row">
                    <div class="info-label">Origin:</div>
                    <div class="info-value">{{ $shipment->origin }}</div>
                </div>

                <div class="info-row">
                    <div class="info-label">Destination:</div>
                    <div class="info-value">{{ $shipment->destination }}</div>
                </div>

                @if($shipment->estimated_delivery_date)
                <div class="info-row">
                    <div class="info-label">Est. Delivery:</div>
                    <div class="info-value">{{ $shipment->estimated_delivery_date->format('F d, Y') }}</div>
                </div>
                @endif
            </div>

            @if($shipment->updates && $shipment->updates->count() > 0)
            <div class="divider"></div>

            <!-- Recent Updates Timeline -->
            <div class="info-section">
                <h3 style="color: #2D3748; font-family: 'Pathway Gothic One', Arial, sans-serif; font-size: 20px; margin-bottom: 20px;">
                    Recent Activity
                </h3>

                @foreach($shipment->updates->sortByDesc('created_at')->take(5) as $recentUpdate)
                <div class="timeline-item">
                    <div class="timeline-time">{{ $recentUpdate->created_at->format('M d, Y - g:i A') }}</div>
                    <div class="timeline-desc">
                        <strong>{{ ucwords(str_replace('_', ' ', $recentUpdate->status)) }}</strong>
                        @if($recentUpdate->location)
                        - {{ $recentUpdate->location }}
                        @endif
                        @if($recentUpdate->description)
                        <br>{{ $recentUpdate->description }}
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
            @endif

            <!-- Track Button -->
            <div class="button-container">
                <a href="{{ route('track') }}?tracking_number={{ $shipment->tracking_number }}" class="cta-button">
                    View Full Tracking Details
                </a>
            </div>

            <p style="text-align: center; font-size: 14px; color: #718096; margin-top: 20px;">
                Or copy this link:<br>
                <a href="{{ route('track') }}?tracking_number={{ $shipment->tracking_number }}" class="tracking-link">
                    {{ route('track') }}?tracking_number={{ $shipment->tracking_number }}
                </a>
            </p>

            <div class="divider"></div>

            <p class="message" style="margin-bottom: 0;">
                We'll continue to keep you updated on your shipment's progress. If you have any questions, please don't hesitate to contact our customer support team.
            </p>
        </div>

        <!-- Footer -->
        <div class="email-footer">
            <p style="font-weight: 600; font-size: 16px; color: #FFFFFF; margin-bottom: 15px;">
                Avenro Logistics
            </p>
            <p>Email: <a href="mailto:{{ $siteSettings->contact_email ?? "info@avenrologistics.com" }}">{{ $siteSettings->contact_email ?? "info@avenrologistics.com" }}</a></p>
            <p>Website: <a href="{{ config('app.url') }}">{{ config('app.url') }}</a></p>
            <p style="margin-top: 20px; font-size: 12px;">
                &copy; {{ date('Y') }} Avenro Logistics. All Rights Reserved.
            </p>
        </div>
    </div>
</body>
</html>
