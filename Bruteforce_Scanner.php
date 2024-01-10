<?php

#------ Bruteforce Scanner [v1] By AGC007™ ------#

#------ Get Data ------#4

if(isset($_REQUEST["LoginPage"]))#~GetPageUrl
{
    if(strstr(strtolower($_REQUEST["LoginPage"]),"http"))
    {
        $Site = $_REQUEST["LoginPage"];
        if(!strstr(strtolower($Site),"https"))
        {
            $Site = str_replace("http","https",$Site);
            Check_BruteForce($Site);
        }
        else
        {
            Check_BruteForce($Site);
        }
    }
    else
    {
        echo("Please Enter The URL of The Login Page (https://dash.cloudflare.com/login)");
    }
}

#------ Get Data ------#

#------ Check BruteForce Function ------#
function Check_BruteForce($Site)#~Check-BruteForce
{
    try {
        $ch = curl_init($Site);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, 1);
        $Respone_REQ = curl_exec($ch);
        curl_close($ch);

        if(strstr(strtolower($Respone_REQ),"captcha"))#~Check-Captcha
        {
            if(strstr(strtolower($Respone_REQ),"recaptcha") || strstr(strtolower($Respone_REQ),"re-captcha"))#~Check-reCaptcha
             {
                if (strstr(strtolower($Respone_REQ), "class=\"g-recaptcha\" data-sitekey=\""))#~Check-reCaptcha-Version
                {
                    $Security_Var = "Hard";
                    $Challenge_Var = "Yes";
                    $Captcha_Var = "Yes"; $reCaptcha_Var = "Yes";

                    $Respone_Var = "The Site's Login Page has Hard Security (reCaptcha[V2] Bypass is Not Possible)";
                }
                else
                {
                    $Security_Var = "Medium";
                    $Challenge_Var = "No";
                    $Captcha_Var = "Yes"; $reCaptcha_Var = "Yes";

                    $Respone_Var = "The Site's Login Page has Good Security(reCaptcha[V3] Bypass is Possible)";
                }
            }
            else
            {
                $Security_Var = "Medium";
                $Challenge_Var = "No";
                $Captcha_Var = "Yes"; $reCaptcha_Var = "No";

                $Respone_Var = "The Site's Login Page has Moderate Security (Captcha Bypass is Possible)";
            }
        }
        else
        {
            if (strstr(strtolower($Respone_REQ), "cloudflare"))#~Check-Cloudflare
            {
                $Security_Var = "Hard";
                $Challenge_Var = "Yes";
                $Captcha_Var = "Unknow"; $reCaptcha_Var = "Unknow";
        
                $Respone_Var = "The Site's Login Page has Hard Security (The Site has A System To Prevent The Entry of Robots)";
        
            }
            else
            {
            $Security_Var = "Low";
            $Challenge_Var = "No";
            $Captcha_Var = "No"; $reCaptcha_Var = "No";

            $Respone_Var = "The Site's Login Page of The Site has Very Low Security";
            }
        }

        echo(
            json_encode(
                array(
                    "Security" => $Security_Var,
                    "Challenge" => $Challenge_Var,
                    "Captcha" => $Captcha_Var,
                    "reCaptcha" => $reCaptcha_Var,
                    "Respone" => " $Respone_Var",
            )
          )
        );
    }
    catch (Exception $ER)#~Error
    {
        $Security_Var = "Hard";
        $Challenge_Var = "Yes";
        $Captcha_Var = "Unknow"; $reCaptcha_Var = "Unknow";

        $Respone_Var = "The Site's Login Page has Hard Security (The Site has A System To Prevent The Entry of Robots)";

        echo(
        json_encode(
            array(
                "Security" => $Security_Var,
                "Challenge" => $Challenge_Var,
                "Captcha" => $Captcha_Var,
                "reCaptcha" => $reCaptcha_Var,
                "Respone" => " $Respone_Var",
            )
        )
        );
    }
}
#------ Check BruteForce Function ------#

#------ Bruteforce Scanner [v1] By AGC007™ ------#