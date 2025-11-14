<?php

declare(strict_types=1);

namespace App\Hooks;

/**
 * CAPTCHA Generator
 * 
 * Usage:
 * <img id="CPcaptcha" src="<?php echo HOOKS_URL;?>captcha"/>
 * <button onclick="document.getElementById('CPcaptcha').src='<?php echo HOOKS_URL;?>captcha'">Refresh</button>
 */
class Captcha
{
    private int $length = 5;
    private int $width = 165;
    private int $height = 50;
    private string $fontDir = 'captcha_fonts/';
    
    public function __construct(int $length = 5)
    {
        $this->length = $length;
        
        if (!session_id()) {
            session_start();
        }
    }
    
    /**
     * Generate and display CAPTCHA image
     */
    public function generate(): void
    {
        // Generate random string
        $string = '';
        $characters = array_merge(range('A', 'Z'), range('a', 'z'), range('0', '9'));
        $charactersLength = count($characters) - 1;
        
        for ($i = 0; $i < $this->length; $i++) {
            $string .= $characters[mt_rand(0, $charactersLength - 1)];
        }
        
        // Store in session
        $_SESSION['captcha'] = $string;
        
        // Create image
        $image = imagecreatetruecolor($this->width, $this->height);
        $textColor = imagecolorallocate($image, 255, 255, 255);
        $bgColor = imagecolorallocate($image, rand(0, 255), rand(0, 255), rand(0, 255));
        imagefilledrectangle($image, 0, 0, $this->width, $this->height, $bgColor);
        
        // Add text with random font
        $fonts = ['Walkway_Black_RevOblique.ttf', 'D3Craftism.ttf'];
        $font = $fonts[rand(0, count($fonts) - 1)];
        $fontSize = ($font === 'Walkway_Black_RevOblique.ttf') ? 30 : 25;
        
        imagettftext($image, $fontSize, 0, 10, 40, $textColor, $this->fontDir . $font, $_SESSION['captcha']);
        
        // Output
        header("Content-type: image/png");
        imagepng($image);
        imagedestroy($image);
    }
    
    /**
     * Validate CAPTCHA
     */
    public static function validate(string $input): bool
    {
        if (!session_id()) {
            session_start();
        }
        
        if (!isset($_SESSION['captcha'])) {
            return false;
        }
        
        $isValid = $_SESSION['captcha'] === $input;
        unset($_SESSION['captcha']);
        
        return $isValid;
    }
}

