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

class VerifiedAddress
{
  private $ErrNumber; // string
  private $ErrDescription; // string

  public function getErrNumber()
  {
    return $this->ErrNumber;
  }

  public function getErrDescription()
  {
    return $this->ErrDescription;
  }

  public function getAddress() {
    return new Address(
      $this->getAddress1(),
      $this->getAddress2(),
      $this->getCity(),
      $this->getState(),
      $this->getZip5(),
      $this->getZip4()
    );
  }

  private function getAddress1()
  {
    return $this->Address1;
  }

  private function getAddress2()
  {
    return (isset($this->Address2)) ? $this->Address2 : NULL;
  }

  private function getCity()
  {
    return $this->City;
  }

  private function getState()
  {
    return $this->State;
  }

  private function getZip5()
  {
    return $this->Zip5;
  }

  private function getZip4()
  {
    return $this->Zip4;
  }
}
