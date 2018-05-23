<?php
    class Helper
    {
        /**
         *  base64_encode() for URLs encoding
         *
         *  @param    string $url
         *  @return   string
         */
        public function urlEncode($url)
        {
            return strtr(base64_encode($url), '+/=', '-_,');
        }

        /**
         *  base64_dencode() for URLs dencoding
         *
         *  @param    string $url
         *  @return   string
         */
        public function urlDecode($url)
        {
            $url = base64_decode(strtr($url, '-_,', '+/='));
            return Mage::getSingleton('core/url')->sessionUrlVar($url);
        }
    }
?>