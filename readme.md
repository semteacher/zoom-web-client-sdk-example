# Simplified example of Zoom SDK for Web Client using JavaScript

- Converting some Angular-specific code to pure/plain/vanilla JavaScript
- Entire PHP script for signature generation

This example removes some of the "extra" things (like default language of English and retaining info in cookies).  For the complete functionality/example, reference the original Zoom SDK code:
### [https://github.com/zoom/sample-app-web](https://github.com/zoom/sample-app-web)


Additional details as to the issues I originally ran into can be found here:
### [https://stevesohcot.medium.com/zoom-web-client-sdk-html5-javascript-php-example-9210f5bda17f](https://stevesohcot.medium.com/zoom-web-client-sdk-html5-javascript-php-example-9210f5bda17f)

# Adopted for Skillman

## Usage

1. Change Zoom JWT (!)keys in keys.php
2. Use same domain (ie learn.skillman/meetinghome pointitng to /zoomwc/www)
3. Insert iframe with valid MeetingID and Pwd:

<iframe style="border:none; height: 600px; width: 100%;" src="https://tdmumoodle4.org/zoomwc/www/?id=96881738675&amp;pwd=1d7zNq" sandbox="allow-forms allow-scripts allow-same-origin allow-pointer-lock allow-popups allow-modals" allow="microphone; camera; fullscreen" allowFullScreen>
</iframe>

OR

<div class="embed-responsive embed-responsive-16by9">
<iframe class="embed-responsive-item" src="https://tdmumoodle4.org/zoomwc/www/?id=96881738675&amp;pwd=1d7zNq" sandbox="allow-forms allow-scripts allow-same-origin allow-pointer-lock allow-popups allow-modals" allow="microphone; camera; fullscreen" allowFullScreen></iframe>
</div>