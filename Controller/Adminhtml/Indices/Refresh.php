<?php
/**
 * @by SwiftOtter, Inc., 2/9/17
 * @website https://swiftotter.com
 **/

namespace TylerSchade\IndexManagement\Controller\Adminhtml\Indices;

use Magento\Backend\App\Action;

class Refresh extends Action
{
    public function _isAllowed()
    {
        return parent::_isAllowed();
    }
}