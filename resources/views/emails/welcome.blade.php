<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Verification</title>
    <style>
        @import url('https://cdn.jsdelivr.net/npm/tailwindcss@2.2.7/dist/tailwind.min.css');
    </style>
</head>

<body class="bg-gray-100">
    <div class="min-h-screen flex items-center justify-center">
        <div class="max-w-sm w-full bg-white shadow-lg rounded-lg overflow-hidden">
            <div class="p-6">
                <h1 class="text-3xl font-bold text-gray-800">OTP Verification</h1>
                <p class="text-gray-600 mt-2">Please use the following One-Time Password (OTP) to verify your account:
                </p>
                <div class="flex items-center justify-center mt-6">
                    <div class="flex items-baseline">
                        <span class="text-5xl font-bold text-gray-800">{{ $otp }}</span>
                    </div>
                </div>
                <p class="text-gray-600 mt-6">This OTP is valid for 5 minutes. Do not share it with anyone.</p>
            </div>
            <div class="bg-gray-100 py-4 px-6 border-t border-gray-200">
                <p class="text-gray-600 text-sm">If you did not request this OTP, no further action is required.</p>
            </div>
        </div>
    </div>
</body>

</html>
