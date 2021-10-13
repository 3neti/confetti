<?php

namespace Database\Seeders;

use LBHurtado\SMS\Facades\SMS;
use Illuminate\Database\Seeder;

class SendConfetti extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mhandles = [
//            '09173011987' => 'Lester Globe',
//            '09189362340' => 'Lester Smart'
//            '09285056550' => 'Joy Rendon',
//            '09178915975' => 'Brod Levi',
//            '09988624283' => 'Brod Levi',
//            '09166033598' => 'Pareng Obbie',
//            '09176254497' => 'Rico',
//            '09275907005' => 'Chicky',
//            '09199902752' => 'Lilibeth',
//            '09276386488' => 'Edwin',
//            '09178329276' => 'Gen. Rio sir',
//            '09175131507' => 'Dens',
//            '09062021800' => 'Joseph',
            '09212824685' => 'Ed'
        ];
        $messages = [
            'TXTCMDR' => 'gumamit ng pre-paid phone na may internet. Ilagay ang tunay na cellphone number at makakakuha ito ng load. Stand by sa Quezon City SMS.',
            'Quezon City' => 'Makilahok sa susunod na eleksiyon. I-click ang bit.ly/GoOutAndRegister.'
        ];

        foreach ($mhandles as $mobile => $handle) {
            foreach ($messages as $senderId => $message) {
                $confetti = $senderId == 'TXTCMDR' ? sprintf('%s, %s', $handle, $message) : $message;
                SMS::channel('engagespark')
                    ->from($senderId)
                    ->to($mobile)
                    ->content($confetti)
                    ->send()
                ;
            }
        }
    }
}
