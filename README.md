# riCaptcha
riCaptcha is a small, privacy-friendly CAPTCHA generator you can host yourself when you don't need heavyweight anti-bot systems, but do not want the door wide open either.

This script renders a noisy PNG image containing a short, randomly generated code and stores that code in  ``$_SESSION['captcha']``. It’s designed for low-risk forms where you just want to trip up generic spam bots without sending users through potentially intrusive third-party challenges.

## What it does

- Generates a 5-character code from `ABCDEFGHJKLMNPQRSTUVWXYZ23456789` (avoids visually similar characters such as `1/I`, `O/0`)
- Stores the code in the current PHP session as `$_SESSION['captcha']`.
- Sends the correct image headers (Content-Type: image/png) and outputs the image

## Requirements
- PHP 8.0+
- GD extension with FreeType enabled
- Sessions
- A readable TTF/OTF font placed alongside the script (not provided here)

Please ensure the font file and the script is readable by the PHP runtime user!

## Installation

- Save your provided script as captcha.php in your web root (or any public path)
- Put a readable .otf or .ttf font in the same directory
- Make sure GD + FreeType and sessions are enabled in PHP

## Disclaimer

This script is provided as-is, and without warranties. It includes only the image generation system. You'll need to provide your own backend and frontend implementations for this script to actually function as captcha.
