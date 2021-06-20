<?php

/**
 * Show error
 * @param string $text error description
 * @return void
 */
function show_error($text, $errorType = "Error")
{
    global $config;

    if ($config['mode'] == "production") {
        return false;
    } else {
        echo "<strong>$errorType:</strong> $text";
    }
}

/**
 * Show 404 Error
 */
function show_404()
{
    $error = "404 Not Found";
    $title = "Not Found";

    echo '
    <!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
    
            <title>' . $title . '</title>
    
            <!-- Styles -->
            <style>
                html, body {
                    background-color: #fff;
                    color: #636b6f;
                    font-family: sans-serif;
                    font-weight: 100;
                    height: 100vh;
                    margin: 0;
                }
    
                .full-height {
                    height: 100vh;
                }
    
                .flex-center {
                    align-items: center;
                    display: flex;
                    justify-content: center;
                }
    
                .position-ref {
                    position: relative;
                }
    
    
                .message {
                    font-size: 18px;
                    text-align: center;
                }
            </style>
        </head>
        <body>
            <div class="flex-center position-ref full-height">
    
                <div class="message" style="padding: 10px;">
                 <h1>' . $error . ' </h1> 
                 </div>
            </div>
        </body>
    </html>';
}
