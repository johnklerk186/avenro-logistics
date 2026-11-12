<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shipment Created - Avenro Logistics</title>
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
        .tracking-box {
            background-color: #F4F6F9;
            border: 2px solid #0F2B4D;
            border-radius: 8px;
            padding: 25px;
            margin: 30px 0;
            text-align: center;
        }
        .tracking-label {
            font-size: 14px;
            color: #718096;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 10px;
        }
        .tracking-number {
            font-size: 32px;
            font-weight: 700;
            color: #0F2B4D;
            font-family: 'Courier New', monospace;
            letter-spacing: 2px;
            margin: 10px 0;
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
        .status-pending {
            background-color: #F4F6F9;
            color: #0F2B4D;
        }
        @media only screen and (max-width: 600px) {
            .email-body {
                padding: 30px 20px;
            }
            .tracking-number {
                font-size: 24px;
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
            <p>Your Shipment Has Been Created</p>
        </div>

        <!-- Body -->
        <div class="email-body">
            <p class="greeting">Dear {{ $shipment->receiver_name }},</p>

            <p class="message">
                We are pleased to inform you that a new shipment has been created and is now being processed. 
                Your package is in our care and will be delivered to you safely.
            </p>

            <!-- Tracking Number Box -->
            <div class="tracking-box">
                <div class="tracking-label">Your Tracking Number</div>
                <div class="tracking-number">{{ $shipment->tracking_number }}</div>
                <p style="margin: 15px 0 0 0; font-size: 14px; color: #718096;">
                    Save this number to track your shipment
                </p>
            </div>

            <!-- Shipment Details -->
            <div class="info-section">
                <h3 style="color: #2D3748; font-family: 'Pathway Gothic One', Arial, sans-serif; font-size: 20px; margin-bottom: 20px;">
                    Shipment Details
                </h3>

                <div class="info-row">
                    <div class="info-label">Status:</div>
                    <div class="info-value">
                        <span class="status-badge status-pending">{{ ucwords(str_replace('_', ' ', $shipment->status)) }}</span>
                    </div>
                </div>

                <div class="info-row">
                    <div class="info-label">Origin:</div>
                    <div class="info-value">{{ $shipment->origin }}</div>
                </div>

                <div class="info-row">
                    <div class="info-label">Destination:</div>
                    <div class="info-value">{{ $shipment->destination }}</div>
                </div>

                @if($shipment->current_location)
                <div class="info-row">
                    <div class="info-label">Current Location:</div>
                    <div class="info-value">{{ $shipment->current_location }}</div>
                </div>
                @endif

                @if($shipment->shipping_type)
                <div class="info-row">
                    <div class="info-label">Shipping Type:</div>
                    <div class="info-value">{{ ucwords(str_replace('_', ' ', $shipment->shipping_type)) }}</div>
                </div>
                @endif

                @if($shipment->weight)
                <div class="info-row">
                    <div class="info-label">Weight:</div>
                    <div class="info-value">{{ $shipment->weight }} kg</div>
                </div>
                @endif

                @if($shipment->estimated_delivery_date)
                <div class="info-row">
                    <div class="info-label">Est. Delivery:</div>
                    <div class="info-value">{{ $shipment->estimated_delivery_date->format('F d, Y') }}</div>
                </div>
                @endif
            </div>

            <div class="divider"></div>

            <!-- Receiver Information -->
            <div class="info-section">
                <h3 style="color: #2D3748; font-family: 'Pathway Gothic One', Arial, sans-serif; font-size: 20px; margin-bottom: 20px;">
                    Delivery Information
                </h3>

                <div class="info-row">
                    <div class="info-label">Recipient:</div>
                    <div class="info-value">{{ $shipment->receiver_name }}</div>
                </div>

                <div class="info-row">
                    <div class="info-label">Phone:</div>
                    <div class="info-value">{{ $shipment->receiver_phone }}</div>
                </div>

                <div class="info-row">
                    <div class="info-label">Address:</div>
                    <div class="info-value">{{ $shipment->receiver_address }}</div>
                </div>
            </div>

            @if($shipment->notes)
            <div class="divider"></div>
            <div class="info-section">
                <h3 style="color: #2D3748; font-family: 'Pathway Gothic One', Arial, sans-serif; font-size: 20px; margin-bottom: 15px;">
                    Additional Notes
                </h3>
                <p style="color: #4A5568; line-height: 1.6;">{{ $shipment->notes }}</p>
            </div>
            @endif

            <!-- Track Button -->
            <div class="button-container">
                <a href="{{ route('track') }}?tracking_number={{ $shipment->tracking_number }}" class="cta-button">
                    Track Your Shipment
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
                If you have any questions about your shipment, please don't hesitate to contact our customer support team.
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
