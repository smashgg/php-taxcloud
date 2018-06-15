<?php

/**
 * Portions Copyright (c) 2009-2012 The Federal Tax Authority, LLC (FedTax).
 * All Rights Reserved.
 *
 * This file contains Original Code and/or Modifications of Original Code as
 * defined in and that are subject to the FedTax Public Source License (the
 * ‘License’). You may not use this file except in compliance with the License.
 * Please obtain a copy of the License at http://FedTax.net/ftpsl.pdf or
 * http://dev.taxcloud.net/ftpsl/ and read it before using this file.
 *
 * The Original Code and all software distributed under the License are
 * distributed on an ‘AS IS’ basis, WITHOUT WARRANTY OF ANY KIND, EITHER
 * EXPRESS OR IMPLIED, AND FEDTAX  HEREBY DISCLAIMS ALL SUCH WARRANTIES,
 * INCLUDING WITHOUT LIMITATION, ANY WARRANTIES OF MERCHANTABILITY, FITNESS FOR
 * A PARTICULAR PURPOSE, QUIET ENJOYMENT OR NON-INFRINGEMENT.
 *
 * Please see the License for the specific language governing rights and
 * limitations under the License.
 *
 *
 *
 * Modifications made August 20, 2013 by Brian Altenhofel
 */

namespace TaxCloud;

class ExemptState
{
  private $StateAbbr; // State
  private $ReasonForExemption; // string
  private $IdentificationNumber; // string

  public function __construct($StateAbbr, $ReasonForExemption, $IdentificationNumber)
  {
    $this->setStateAbbr($StateAbbr);
    $this->setReasonForExemption($ReasonForExemption);
    $this->setIdentificationNumber($IdentificationNumber);
  }

  private function setStateAbbr($StateAbbr)
  {
    $this->StateAbbr = constant("State::$StateAbbr");
  }

  public function getStateAbbr()
  {
    return $this->StateAbbr;
  }

  private function setReasonForExemption($ReasonForExemption)
  {
    $this->ReasonForExemption = $ReasonForExemption;
  }

  public function getReasonForExemption()
  {
    return $this->ReasonForExemption;
  }

  private function setIdentificationNumber($IdentificationNumber)
  {
    $this->IdentificationNumber = $IdentificationNumber;
  }

  public function getIdentificationNumber()
  {
    return $this->IdentificationNumber;
  }
}
