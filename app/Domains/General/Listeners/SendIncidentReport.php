<?php

namespace App\Domains\General\Listeners;

use App\Domains\General\Events\ContactReported;
use App\Models\Contact;
use App\Exceptions\DDayConstantException;
use Illuminate\Support\Arr;
use LBHurtado\EngageSpark\EngageSpark;
use Lorisleiva\Actions\Concerns\AsAction;
use App\Domains\Common\Notifications\{Acknowledgment, Report};

class SendIncidentReport
{
    use AsAction;

    public $post;

    public function handle(Contact $contact)
    {
        $contact->notify((new Acknowledgment())->setMessage("Thank you for your report."));

        foreach (explode(',', config('confetti.forward.report')) as $mobile) {
            $forward = Contact::firstOrCreate(compact('mobile'));
            $forward->notify((new Report())->setMessage($this->getMessage()));
        }
    }

    public function asListener(ContactReported $event): void
    {
        $this->post = $event->post;

        $this->handle($event->post->contact);
    }

    protected function getMessage()
    {
        $title = 'Incident Report';
        $from = 'From: ' . $this->post->contact->mobile;
        $message = "Type: " . $this->post->incident . "\r\n" . "Action: " . $this->post->action . "\r\n" . "Remarks: " . $this->post->remarks;
        try {
            $geotag = implode("\r\n", Arr::only($this->post->geotag, ["Datetime", "Street", "Neighborhood", "City"]));
        } catch (\Exception $e) {
            $geotag = implode("\r\n", $this->post->geotag);
        }

        return $title . "\r\n" . "\r\n" . $from . "\r\n" . $message . "\r\n" . "\r\n" . $geotag;
    }
}
