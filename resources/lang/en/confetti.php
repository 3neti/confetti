<?php

use App\Enums\DDayStage;

return [
    'acknowledgement' => [
        'registration' => 'Your participation is very much appreciated!  Thank you. - HQ'
    ],
    'topup' => [
        'expectation' => 'Please stand by - you will receive a "pasa load" shortly.  Thank you. - HQ',
    ],
    'campaign' => [
        'welcome' => 'Welcome to the campaign!  Thank you.',
        'link' => ':name Campaign: Click the :description link: :link',
    ],
    'dday' => [
        'authorization' => 'This is your authorization code: :pin. You will use it to authenticate your reports. - HQ',
        'instructions' => [
            DDayStage::CHECKIN =>
                "Thank you for becoming a volunteer. This system of text messages will be your poll watching guide. " .
                "You will receive a separate SMS for the URL link. You will need an internet connection. " .
                "Enter the data required by the system and follow the instructions. " .
                "You should know the way to your assigned precinct. Be there by 6:00 AM. ".
                "Bring your official ID, mobile phone, pen and paper. " .
                "You will given enough cellphone load and GCash in order for you to perform your duties.",
            DDayStage::INGRESS =>
                "1. You will receive a PIN - memorize it. 2. Proceed to your assigned precinct. " .
                "3. Find out the cluster # of the precinct. 4. Know the name of the BEI Chairperson. " .
                "5. Check the status of the VCM - if it's sealed or not. 6. Register in attendance sheet right away. ".
                "You will receive a separate SMS for the URL link of the next stage. " .
                "8. Click the link when you're inside the voting center.",
            DDayStage::VOTE =>
                "1. Vote right away! 2. Take a picture of the ballot receipt if you can. 3. Don't go out. " .
                "4. Find out if there are policemen and military men nearby. 5. Stay vigilant! " .
                "You will receive a separate SMS for the URL link of the next stage. " .
                "6. Click the link when BEI has voting has ended and the results are already finalized.",
            DDayStage::COUNT =>
                "1. Take a picture of the results in the blackboard if you can. 2. Don't go out. " .
                "3. Find out the winners in each of the positions 4. Stay vigilant! " .
                "You will receive a separate SMS for the URL link of the next stage. " .
                "5. Click the link when BEI has transmitted or failed to transmit.",
            DDayStage::TRANSMISSION =>
                "1. Take a picture of the printed election return if you can. 2. Don't go out. " .
                "3. Find out if the transmission was successful. 4. Or if the SD Card has been retrieved. ".
                "5. Stay vigilant!" .
                "You will receive a separate SMS for the URL link of the next stage. " .
                "6. Click the link when you just left the voting center.",
            DDayStage::EGRESS =>
                "1. You may safely leave the voting center. 2. Go straight home. " .
                "3. From the electronic election return, you will be reporting the result of the candidate's position. ".
                "4. Thank you!" .
                "You will receive your payment shortly. " .
                "5. Click the link when you are already safe outside.",

        ],
        'link' => 'To :description, please click the following :name link: :link',
    ],
    'remarks' => [
        'opening' => 'Welcome...',
        'closing' => 'Thank you for participating. https://bit.ly/OCTAViberGroup - OCTA',
    ],
    'reminder' => 'This is a reminder.', //deprecate
];
