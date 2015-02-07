<?php

namespace Map;

use \Campaign;
use \CampaignQuery;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;


/**
 * This class defines the structure of the 'campaign' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class CampaignTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.CampaignTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'hophacks';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'campaign';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Campaign';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Campaign';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 8;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 8;

    /**
     * the column name for the id field
     */
    const COL_ID = 'campaign.id';

    /**
     * the column name for the user_id field
     */
    const COL_USER_ID = 'campaign.user_id';

    /**
     * the column name for the name field
     */
    const COL_NAME = 'campaign.name';

    /**
     * the column name for the begin_date field
     */
    const COL_BEGIN_DATE = 'campaign.begin_date';

    /**
     * the column name for the end_date field
     */
    const COL_END_DATE = 'campaign.end_date';

    /**
     * the column name for the campaign_status_id field
     */
    const COL_CAMPAIGN_STATUS_ID = 'campaign.campaign_status_id';

    /**
     * the column name for the balance_id field
     */
    const COL_BALANCE_ID = 'campaign.balance_id';

    /**
     * the column name for the activity_id field
     */
    const COL_ACTIVITY_ID = 'campaign.activity_id';

    /**
     * The default string format for model objects of the related table
     */
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        self::TYPE_PHPNAME       => array('Id', 'UserId', 'Name', 'BeginDate', 'EndDate', 'CampaignStatusId', 'BalanceId', 'ActivityId', ),
        self::TYPE_CAMELNAME     => array('id', 'userId', 'name', 'beginDate', 'endDate', 'campaignStatusId', 'balanceId', 'activityId', ),
        self::TYPE_COLNAME       => array(CampaignTableMap::COL_ID, CampaignTableMap::COL_USER_ID, CampaignTableMap::COL_NAME, CampaignTableMap::COL_BEGIN_DATE, CampaignTableMap::COL_END_DATE, CampaignTableMap::COL_CAMPAIGN_STATUS_ID, CampaignTableMap::COL_BALANCE_ID, CampaignTableMap::COL_ACTIVITY_ID, ),
        self::TYPE_FIELDNAME     => array('id', 'user_id', 'name', 'begin_date', 'end_date', 'campaign_status_id', 'balance_id', 'activity_id', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'UserId' => 1, 'Name' => 2, 'BeginDate' => 3, 'EndDate' => 4, 'CampaignStatusId' => 5, 'BalanceId' => 6, 'ActivityId' => 7, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'userId' => 1, 'name' => 2, 'beginDate' => 3, 'endDate' => 4, 'campaignStatusId' => 5, 'balanceId' => 6, 'activityId' => 7, ),
        self::TYPE_COLNAME       => array(CampaignTableMap::COL_ID => 0, CampaignTableMap::COL_USER_ID => 1, CampaignTableMap::COL_NAME => 2, CampaignTableMap::COL_BEGIN_DATE => 3, CampaignTableMap::COL_END_DATE => 4, CampaignTableMap::COL_CAMPAIGN_STATUS_ID => 5, CampaignTableMap::COL_BALANCE_ID => 6, CampaignTableMap::COL_ACTIVITY_ID => 7, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'user_id' => 1, 'name' => 2, 'begin_date' => 3, 'end_date' => 4, 'campaign_status_id' => 5, 'balance_id' => 6, 'activity_id' => 7, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, )
    );

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('campaign');
        $this->setPhpName('Campaign');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Campaign');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('user_id', 'UserId', 'INTEGER', false, null, null);
        $this->addColumn('name', 'Name', 'VARCHAR', false, 255, null);
        $this->addColumn('begin_date', 'BeginDate', 'DATE', false, null, null);
        $this->addColumn('end_date', 'EndDate', 'DATE', false, null, null);
        $this->addForeignKey('campaign_status_id', 'CampaignStatusId', 'INTEGER', 'campaign_status', 'id', false, null, null);
        $this->addForeignKey('balance_id', 'BalanceId', 'INTEGER', 'balance', 'id', false, null, null);
        $this->addForeignKey('activity_id', 'ActivityId', 'INTEGER', 'activity', 'id', false, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('CampaignStatus', '\\CampaignStatus', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':campaign_status_id',
    1 => ':id',
  ),
), null, null, null, false);
        $this->addRelation('Balance', '\\Balance', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':balance_id',
    1 => ':id',
  ),
), null, null, null, false);
        $this->addRelation('Activity', '\\Activity', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':activity_id',
    1 => ':id',
  ),
), null, null, null, false);
        $this->addRelation('Partnership', '\\Partnership', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':campaign_id',
    1 => ':id',
  ),
), null, null, 'Partnerships', false);
    } // buildRelations()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return string The primary key hash of the row
     */
    public static function getPrimaryKeyHashFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        return (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)
        ];
    }

    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param boolean $withPrefix Whether or not to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass($withPrefix = true)
    {
        return $withPrefix ? CampaignTableMap::CLASS_DEFAULT : CampaignTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array  $row       row returned by DataFetcher->fetch().
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return array           (Campaign object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = CampaignTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = CampaignTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + CampaignTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = CampaignTableMap::OM_CLASS;
            /** @var Campaign $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            CampaignTableMap::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher)
    {
        $results = array();

        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = CampaignTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = CampaignTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Campaign $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                CampaignTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria object containing the columns to add.
     * @param string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(CampaignTableMap::COL_ID);
            $criteria->addSelectColumn(CampaignTableMap::COL_USER_ID);
            $criteria->addSelectColumn(CampaignTableMap::COL_NAME);
            $criteria->addSelectColumn(CampaignTableMap::COL_BEGIN_DATE);
            $criteria->addSelectColumn(CampaignTableMap::COL_END_DATE);
            $criteria->addSelectColumn(CampaignTableMap::COL_CAMPAIGN_STATUS_ID);
            $criteria->addSelectColumn(CampaignTableMap::COL_BALANCE_ID);
            $criteria->addSelectColumn(CampaignTableMap::COL_ACTIVITY_ID);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.user_id');
            $criteria->addSelectColumn($alias . '.name');
            $criteria->addSelectColumn($alias . '.begin_date');
            $criteria->addSelectColumn($alias . '.end_date');
            $criteria->addSelectColumn($alias . '.campaign_status_id');
            $criteria->addSelectColumn($alias . '.balance_id');
            $criteria->addSelectColumn($alias . '.activity_id');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getServiceContainer()->getDatabaseMap(CampaignTableMap::DATABASE_NAME)->getTable(CampaignTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(CampaignTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(CampaignTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new CampaignTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Campaign or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Campaign object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param  ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ConnectionInterface $con = null)
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CampaignTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Campaign) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(CampaignTableMap::DATABASE_NAME);
            $criteria->add(CampaignTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = CampaignQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            CampaignTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                CampaignTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the campaign table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return CampaignQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Campaign or Criteria object.
     *
     * @param mixed               $criteria Criteria or Campaign object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CampaignTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Campaign object
        }

        if ($criteria->containsKey(CampaignTableMap::COL_ID) && $criteria->keyContainsValue(CampaignTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.CampaignTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = CampaignQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // CampaignTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
CampaignTableMap::buildTableMap();
