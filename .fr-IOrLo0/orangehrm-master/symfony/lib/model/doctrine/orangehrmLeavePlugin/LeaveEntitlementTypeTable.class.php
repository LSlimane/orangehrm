<?php

/**
 * LeaveEntitlementTypeTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class LeaveEntitlementTypeTable extends PluginLeaveEntitlementTypeTable
{
    /**
     * Returns an instance of this class.
     *
     * @return object LeaveEntitlementTypeTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('LeaveEntitlementType');
    }
}