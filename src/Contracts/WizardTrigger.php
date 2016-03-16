<?php
/**
 * Created by PhpStorm.
 * User: Vincent
 * Date: 16/03/2016
 * Time: 10:18
 */

namespace MarvinLabs\SetupWizard\Contracts;


interface WizardTrigger
{

    /**
     * Indicates if the wizard should be launched or not
     *
     * @return boolean
     */
    function shouldLaunchWizard();

}