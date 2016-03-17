<?php

namespace MarvinLabs\SetupWizard\Steps;

use Illuminate\Support\MessageBag;
use MarvinLabs\SetupWizard\Contracts\WizardStep;

abstract class BaseStep implements WizardStep
{
    /** @var string The unique identifier for the step */
    protected $id;

    /** @var \Illuminate\Contracts\Support\MessageBag The errors that got detected when applying/undoing the step */
    protected $errors;

    /**
     * BaseStep constructor.
     *
     * @param string $id The unique identifier for the step
     */
    public function __construct($id)
    {
        $this->id = $id;
        $this->errors = null;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getFormData()
    {
        return [];
    }

    public function getSlug()
    {
        return trans('setup_wizard::steps.' . $this->getId() . '.slug');
    }

    public function getMessageBag()
    {
        return $this->errors;
    }

    protected function mergeErrors($messages)
    {
        if ($this->errors==null) {
            $this->errors = new MessageBag();
        }

        $this->errors->merge($messages);
    }

    protected function addError($key, $message)
    {
        if ($this->errors==null) {
            $this->errors = new MessageBag();
        }

        $this->errors->add($key, $message);
    }
}