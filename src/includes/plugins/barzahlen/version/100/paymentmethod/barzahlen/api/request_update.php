<?php
/**
 * Barzahlen Payment Module SDK
 *
 * NOTICE OF LICENSE
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; version 3 of the License
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see http://www.gnu.org/licenses/
 *
 * @copyright   Copyright (c) 2012 Zerebro Internet GmbH (http://www.barzahlen.de)
 * @author      Alexander Diebler
 * @license     http://opensource.org/licenses/GPL-3.0  GNU General Public License, version 3 (GPL-3.0)
 */

class Barzahlen_Request_Update extends Barzahlen_Request_Base {

  protected $_type = 'update'; //!< request type
  protected $_transactionId; //!< origin transaction id
  protected $_orderId; //!< order id

  protected $_xmlAttributes = array('transaction-id', 'result', 'hash'); //!< update xml content

  /**
   * Construtor to set variable request settings.
   *
   * @param string $transactionId origin transaction id
   * @param string $orderId order id
   */
  public function __construct($transactionId, $orderId) {

    $this->_transactionId = $transactionId;
    $this->_orderId = $orderId;
  }

  /**
   * Builds array for request.
   *
   * @param string $shopId merchants shop id
   * @param string $paymentKey merchants payment key
   * @param string $language langauge code (ISO 639-1)
   * @param array $customVar custom variables from merchant
   * @return array for update request
   */
  public function buildRequestArray($shopId, $paymentKey, $language, array $customVar) {

    $requestArray = array();
    $requestArray['shop_id'] = $shopId;
    $requestArray['transaction_id'] = $this->_transactionId;
    $requestArray['order_id'] = $this->_orderId;
    $requestArray['hash'] = $this->_createHash($requestArray, $paymentKey);

    $this->_removeEmptyValues($requestArray);
    return $requestArray;
  }

  /**
   * Returns transaction id from xml array.
   *
   * @return received transaction id
   */
  public function getTransactionId() {
    return $this->getXmlArray('transaction-id');
  }
}
?>