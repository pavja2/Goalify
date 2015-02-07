<?php

namespace Base;

use \Activity as ChildActivity;
use \ActivityQuery as ChildActivityQuery;
use \Balance as ChildBalance;
use \BalanceQuery as ChildBalanceQuery;
use \Campaign as ChildCampaign;
use \CampaignQuery as ChildCampaignQuery;
use \CampaignStatus as ChildCampaignStatus;
use \CampaignStatusQuery as ChildCampaignStatusQuery;
use \Partnership as ChildPartnership;
use \PartnershipQuery as ChildPartnershipQuery;
use \DateTime;
use \Exception;
use \PDO;
use Map\CampaignTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;
use Propel\Runtime\Util\PropelDateTime;

/**
 * Base class that represents a row from the 'campaign' table.
 *
 *
 *
* @package    propel.generator..Base
*/
abstract class Campaign implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Map\\CampaignTableMap';


    /**
     * attribute to determine if this object has previously been saved.
     * @var boolean
     */
    protected $new = true;

    /**
     * attribute to determine whether this object has been deleted.
     * @var boolean
     */
    protected $deleted = false;

    /**
     * The columns that have been modified in current object.
     * Tracking modified columns allows us to only update modified columns.
     * @var array
     */
    protected $modifiedColumns = array();

    /**
     * The (virtual) columns that are added at runtime
     * The formatters can add supplementary columns based on a resultset
     * @var array
     */
    protected $virtualColumns = array();

    /**
     * The value for the id field.
     * @var        int
     */
    protected $id;

    /**
     * The value for the user_id field.
     * @var        int
     */
    protected $user_id;

    /**
     * The value for the begin_date field.
     * @var        \DateTime
     */
    protected $begin_date;

    /**
     * The value for the end_date field.
     * @var        \DateTime
     */
    protected $end_date;

    /**
     * The value for the campaign_status_id field.
     * @var        int
     */
    protected $campaign_status_id;

    /**
     * The value for the balance_id field.
     * @var        int
     */
    protected $balance_id;

    /**
     * The value for the activity_id field.
     * @var        int
     */
    protected $activity_id;

    /**
     * @var        ChildCampaignStatus
     */
    protected $aCampaignStatus;

    /**
     * @var        ChildBalance
     */
    protected $aBalance;

    /**
     * @var        ChildActivity
     */
    protected $aActivity;

    /**
     * @var        ObjectCollection|ChildPartnership[] Collection to store aggregation of ChildPartnership objects.
     */
    protected $collPartnerships;
    protected $collPartnershipsPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildPartnership[]
     */
    protected $partnershipsScheduledForDeletion = null;

    /**
     * Initializes internal state of Base\Campaign object.
     */
    public function __construct()
    {
    }

    /**
     * Returns whether the object has been modified.
     *
     * @return boolean True if the object has been modified.
     */
    public function isModified()
    {
        return !!$this->modifiedColumns;
    }

    /**
     * Has specified column been modified?
     *
     * @param  string  $col column fully qualified name (TableMap::TYPE_COLNAME), e.g. Book::AUTHOR_ID
     * @return boolean True if $col has been modified.
     */
    public function isColumnModified($col)
    {
        return $this->modifiedColumns && isset($this->modifiedColumns[$col]);
    }

    /**
     * Get the columns that have been modified in this object.
     * @return array A unique list of the modified column names for this object.
     */
    public function getModifiedColumns()
    {
        return $this->modifiedColumns ? array_keys($this->modifiedColumns) : [];
    }

    /**
     * Returns whether the object has ever been saved.  This will
     * be false, if the object was retrieved from storage or was created
     * and then saved.
     *
     * @return boolean true, if the object has never been persisted.
     */
    public function isNew()
    {
        return $this->new;
    }

    /**
     * Setter for the isNew attribute.  This method will be called
     * by Propel-generated children and objects.
     *
     * @param boolean $b the state of the object.
     */
    public function setNew($b)
    {
        $this->new = (boolean) $b;
    }

    /**
     * Whether this object has been deleted.
     * @return boolean The deleted state of this object.
     */
    public function isDeleted()
    {
        return $this->deleted;
    }

    /**
     * Specify whether this object has been deleted.
     * @param  boolean $b The deleted state of this object.
     * @return void
     */
    public function setDeleted($b)
    {
        $this->deleted = (boolean) $b;
    }

    /**
     * Sets the modified state for the object to be false.
     * @param  string $col If supplied, only the specified column is reset.
     * @return void
     */
    public function resetModified($col = null)
    {
        if (null !== $col) {
            if (isset($this->modifiedColumns[$col])) {
                unset($this->modifiedColumns[$col]);
            }
        } else {
            $this->modifiedColumns = array();
        }
    }

    /**
     * Compares this with another <code>Campaign</code> instance.  If
     * <code>obj</code> is an instance of <code>Campaign</code>, delegates to
     * <code>equals(Campaign)</code>.  Otherwise, returns <code>false</code>.
     *
     * @param  mixed   $obj The object to compare to.
     * @return boolean Whether equal to the object specified.
     */
    public function equals($obj)
    {
        if (!$obj instanceof static) {
            return false;
        }

        if ($this === $obj) {
            return true;
        }

        if (null === $this->getPrimaryKey() || null === $obj->getPrimaryKey()) {
            return false;
        }

        return $this->getPrimaryKey() === $obj->getPrimaryKey();
    }

    /**
     * Get the associative array of the virtual columns in this object
     *
     * @return array
     */
    public function getVirtualColumns()
    {
        return $this->virtualColumns;
    }

    /**
     * Checks the existence of a virtual column in this object
     *
     * @param  string  $name The virtual column name
     * @return boolean
     */
    public function hasVirtualColumn($name)
    {
        return array_key_exists($name, $this->virtualColumns);
    }

    /**
     * Get the value of a virtual column in this object
     *
     * @param  string $name The virtual column name
     * @return mixed
     *
     * @throws PropelException
     */
    public function getVirtualColumn($name)
    {
        if (!$this->hasVirtualColumn($name)) {
            throw new PropelException(sprintf('Cannot get value of inexistent virtual column %s.', $name));
        }

        return $this->virtualColumns[$name];
    }

    /**
     * Set the value of a virtual column in this object
     *
     * @param string $name  The virtual column name
     * @param mixed  $value The value to give to the virtual column
     *
     * @return $this|Campaign The current object, for fluid interface
     */
    public function setVirtualColumn($name, $value)
    {
        $this->virtualColumns[$name] = $value;

        return $this;
    }

    /**
     * Logs a message using Propel::log().
     *
     * @param  string  $msg
     * @param  int     $priority One of the Propel::LOG_* logging levels
     * @return boolean
     */
    protected function log($msg, $priority = Propel::LOG_INFO)
    {
        return Propel::log(get_class($this) . ': ' . $msg, $priority);
    }

    /**
     * Export the current object properties to a string, using a given parser format
     * <code>
     * $book = BookQuery::create()->findPk(9012);
     * echo $book->exportTo('JSON');
     *  => {"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * @param  mixed   $parser                 A AbstractParser instance, or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param  boolean $includeLazyLoadColumns (optional) Whether to include lazy load(ed) columns. Defaults to TRUE.
     * @return string  The exported data
     */
    public function exportTo($parser, $includeLazyLoadColumns = true)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        return $parser->fromArray($this->toArray(TableMap::TYPE_PHPNAME, $includeLazyLoadColumns, array(), true));
    }

    /**
     * Clean up internal collections prior to serializing
     * Avoids recursive loops that turn into segmentation faults when serializing
     */
    public function __sleep()
    {
        $this->clearAllReferences();

        return array_keys(get_object_vars($this));
    }

    /**
     * Get the [id] column value.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the [user_id] column value.
     *
     * @return int
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * Get the [optionally formatted] temporal [begin_date] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getBeginDate($format = NULL)
    {
        if ($format === null) {
            return $this->begin_date;
        } else {
            return $this->begin_date instanceof \DateTime ? $this->begin_date->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [end_date] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getEndDate($format = NULL)
    {
        if ($format === null) {
            return $this->end_date;
        } else {
            return $this->end_date instanceof \DateTime ? $this->end_date->format($format) : null;
        }
    }

    /**
     * Get the [campaign_status_id] column value.
     *
     * @return int
     */
    public function getCampaignStatusId()
    {
        return $this->campaign_status_id;
    }

    /**
     * Get the [balance_id] column value.
     *
     * @return int
     */
    public function getBalanceId()
    {
        return $this->balance_id;
    }

    /**
     * Get the [activity_id] column value.
     *
     * @return int
     */
    public function getActivityId()
    {
        return $this->activity_id;
    }

    /**
     * Set the value of [id] column.
     *
     * @param int $v new value
     * @return $this|\Campaign The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[CampaignTableMap::COL_ID] = true;
        }

        return $this;
    } // setId()

    /**
     * Set the value of [user_id] column.
     *
     * @param int $v new value
     * @return $this|\Campaign The current object (for fluent API support)
     */
    public function setUserId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->user_id !== $v) {
            $this->user_id = $v;
            $this->modifiedColumns[CampaignTableMap::COL_USER_ID] = true;
        }

        return $this;
    } // setUserId()

    /**
     * Sets the value of [begin_date] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\Campaign The current object (for fluent API support)
     */
    public function setBeginDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->begin_date !== null || $dt !== null) {
            if ($dt !== $this->begin_date) {
                $this->begin_date = $dt;
                $this->modifiedColumns[CampaignTableMap::COL_BEGIN_DATE] = true;
            }
        } // if either are not null

        return $this;
    } // setBeginDate()

    /**
     * Sets the value of [end_date] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\Campaign The current object (for fluent API support)
     */
    public function setEndDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->end_date !== null || $dt !== null) {
            if ($dt !== $this->end_date) {
                $this->end_date = $dt;
                $this->modifiedColumns[CampaignTableMap::COL_END_DATE] = true;
            }
        } // if either are not null

        return $this;
    } // setEndDate()

    /**
     * Set the value of [campaign_status_id] column.
     *
     * @param int $v new value
     * @return $this|\Campaign The current object (for fluent API support)
     */
    public function setCampaignStatusId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->campaign_status_id !== $v) {
            $this->campaign_status_id = $v;
            $this->modifiedColumns[CampaignTableMap::COL_CAMPAIGN_STATUS_ID] = true;
        }

        if ($this->aCampaignStatus !== null && $this->aCampaignStatus->getId() !== $v) {
            $this->aCampaignStatus = null;
        }

        return $this;
    } // setCampaignStatusId()

    /**
     * Set the value of [balance_id] column.
     *
     * @param int $v new value
     * @return $this|\Campaign The current object (for fluent API support)
     */
    public function setBalanceId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->balance_id !== $v) {
            $this->balance_id = $v;
            $this->modifiedColumns[CampaignTableMap::COL_BALANCE_ID] = true;
        }

        if ($this->aBalance !== null && $this->aBalance->getId() !== $v) {
            $this->aBalance = null;
        }

        return $this;
    } // setBalanceId()

    /**
     * Set the value of [activity_id] column.
     *
     * @param int $v new value
     * @return $this|\Campaign The current object (for fluent API support)
     */
    public function setActivityId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->activity_id !== $v) {
            $this->activity_id = $v;
            $this->modifiedColumns[CampaignTableMap::COL_ACTIVITY_ID] = true;
        }

        if ($this->aActivity !== null && $this->aActivity->getId() !== $v) {
            $this->aActivity = null;
        }

        return $this;
    } // setActivityId()

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return boolean Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues()
    {
        // otherwise, everything was equal, so return TRUE
        return true;
    } // hasOnlyDefaultValues()

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (0-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows.  This is needed, for example,
     * for results of JOIN queries where the resultset row includes columns from two or
     * more tables.
     *
     * @param array   $row       The row returned by DataFetcher->fetch().
     * @param int     $startcol  0-based offset column which indicates which restultset column to start with.
     * @param boolean $rehydrate Whether this object is being re-hydrated from the database.
     * @param string  $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                  One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                            TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @return int             next starting column
     * @throws PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate($row, $startcol = 0, $rehydrate = false, $indexType = TableMap::TYPE_NUM)
    {
        try {

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : CampaignTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : CampaignTableMap::translateFieldName('UserId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->user_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : CampaignTableMap::translateFieldName('BeginDate', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00') {
                $col = null;
            }
            $this->begin_date = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : CampaignTableMap::translateFieldName('EndDate', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00') {
                $col = null;
            }
            $this->end_date = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : CampaignTableMap::translateFieldName('CampaignStatusId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->campaign_status_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : CampaignTableMap::translateFieldName('BalanceId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->balance_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : CampaignTableMap::translateFieldName('ActivityId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->activity_id = (null !== $col) ? (int) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 7; // 7 = CampaignTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Campaign'), 0, $e);
        }
    }

    /**
     * Checks and repairs the internal consistency of the object.
     *
     * This method is executed after an already-instantiated object is re-hydrated
     * from the database.  It exists to check any foreign keys to make sure that
     * the objects related to the current object are correct based on foreign key.
     *
     * You can override this method in the stub class, but you should always invoke
     * the base method from the overridden method (i.e. parent::ensureConsistency()),
     * in case your model changes.
     *
     * @throws PropelException
     */
    public function ensureConsistency()
    {
        if ($this->aCampaignStatus !== null && $this->campaign_status_id !== $this->aCampaignStatus->getId()) {
            $this->aCampaignStatus = null;
        }
        if ($this->aBalance !== null && $this->balance_id !== $this->aBalance->getId()) {
            $this->aBalance = null;
        }
        if ($this->aActivity !== null && $this->activity_id !== $this->aActivity->getId()) {
            $this->aActivity = null;
        }
    } // ensureConsistency

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param      boolean $deep (optional) Whether to also de-associated any related objects.
     * @param      ConnectionInterface $con (optional) The ConnectionInterface connection to use.
     * @return void
     * @throws PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload($deep = false, ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(CampaignTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildCampaignQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aCampaignStatus = null;
            $this->aBalance = null;
            $this->aActivity = null;
            $this->collPartnerships = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Campaign::setDeleted()
     * @see Campaign::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(CampaignTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildCampaignQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $this->setDeleted(true);
            }
        });
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see doSave()
     */
    public function save(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(CampaignTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $isInsert = $this->isNew();
            $ret = $this->preSave($con);
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
            } else {
                $ret = $ret && $this->preUpdate($con);
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                CampaignTableMap::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }

            return $affectedRows;
        });
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see save()
     */
    protected function doSave(ConnectionInterface $con)
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            // We call the save method on the following object(s) if they
            // were passed to this object by their corresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aCampaignStatus !== null) {
                if ($this->aCampaignStatus->isModified() || $this->aCampaignStatus->isNew()) {
                    $affectedRows += $this->aCampaignStatus->save($con);
                }
                $this->setCampaignStatus($this->aCampaignStatus);
            }

            if ($this->aBalance !== null) {
                if ($this->aBalance->isModified() || $this->aBalance->isNew()) {
                    $affectedRows += $this->aBalance->save($con);
                }
                $this->setBalance($this->aBalance);
            }

            if ($this->aActivity !== null) {
                if ($this->aActivity->isModified() || $this->aActivity->isNew()) {
                    $affectedRows += $this->aActivity->save($con);
                }
                $this->setActivity($this->aActivity);
            }

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                    $affectedRows += 1;
                } else {
                    $affectedRows += $this->doUpdate($con);
                }
                $this->resetModified();
            }

            if ($this->partnershipsScheduledForDeletion !== null) {
                if (!$this->partnershipsScheduledForDeletion->isEmpty()) {
                    foreach ($this->partnershipsScheduledForDeletion as $partnership) {
                        // need to save related object because we set the relation to null
                        $partnership->save($con);
                    }
                    $this->partnershipsScheduledForDeletion = null;
                }
            }

            if ($this->collPartnerships !== null) {
                foreach ($this->collPartnerships as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    } // doSave()

    /**
     * Insert the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @throws PropelException
     * @see doSave()
     */
    protected function doInsert(ConnectionInterface $con)
    {
        $modifiedColumns = array();
        $index = 0;

        $this->modifiedColumns[CampaignTableMap::COL_ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . CampaignTableMap::COL_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(CampaignTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = 'id';
        }
        if ($this->isColumnModified(CampaignTableMap::COL_USER_ID)) {
            $modifiedColumns[':p' . $index++]  = 'user_id';
        }
        if ($this->isColumnModified(CampaignTableMap::COL_BEGIN_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'begin_date';
        }
        if ($this->isColumnModified(CampaignTableMap::COL_END_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'end_date';
        }
        if ($this->isColumnModified(CampaignTableMap::COL_CAMPAIGN_STATUS_ID)) {
            $modifiedColumns[':p' . $index++]  = 'campaign_status_id';
        }
        if ($this->isColumnModified(CampaignTableMap::COL_BALANCE_ID)) {
            $modifiedColumns[':p' . $index++]  = 'balance_id';
        }
        if ($this->isColumnModified(CampaignTableMap::COL_ACTIVITY_ID)) {
            $modifiedColumns[':p' . $index++]  = 'activity_id';
        }

        $sql = sprintf(
            'INSERT INTO campaign (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'id':
                        $stmt->bindValue($identifier, $this->id, PDO::PARAM_INT);
                        break;
                    case 'user_id':
                        $stmt->bindValue($identifier, $this->user_id, PDO::PARAM_INT);
                        break;
                    case 'begin_date':
                        $stmt->bindValue($identifier, $this->begin_date ? $this->begin_date->format("Y-m-d H:i:s") : null, PDO::PARAM_STR);
                        break;
                    case 'end_date':
                        $stmt->bindValue($identifier, $this->end_date ? $this->end_date->format("Y-m-d H:i:s") : null, PDO::PARAM_STR);
                        break;
                    case 'campaign_status_id':
                        $stmt->bindValue($identifier, $this->campaign_status_id, PDO::PARAM_INT);
                        break;
                    case 'balance_id':
                        $stmt->bindValue($identifier, $this->balance_id, PDO::PARAM_INT);
                        break;
                    case 'activity_id':
                        $stmt->bindValue($identifier, $this->activity_id, PDO::PARAM_INT);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

        try {
            $pk = $con->lastInsertId();
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        $this->setId($pk);

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @return Integer Number of updated rows
     * @see doSave()
     */
    protected function doUpdate(ConnectionInterface $con)
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();

        return $selectCriteria->doUpdate($valuesCriteria, $con);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param      string $name name
     * @param      string $type The type of fieldname the $name is of:
     *                     one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                     TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                     Defaults to TableMap::TYPE_PHPNAME.
     * @return mixed Value of field.
     */
    public function getByName($name, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = CampaignTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param      int $pos position in xml schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition($pos)
    {
        switch ($pos) {
            case 0:
                return $this->getId();
                break;
            case 1:
                return $this->getUserId();
                break;
            case 2:
                return $this->getBeginDate();
                break;
            case 3:
                return $this->getEndDate();
                break;
            case 4:
                return $this->getCampaignStatusId();
                break;
            case 5:
                return $this->getBalanceId();
                break;
            case 6:
                return $this->getActivityId();
                break;
            default:
                return null;
                break;
        } // switch()
    }

    /**
     * Exports the object as an array.
     *
     * You can specify the key type of the array by passing one of the class
     * type constants.
     *
     * @param     string  $keyType (optional) One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     *                    TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                    Defaults to TableMap::TYPE_PHPNAME.
     * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to TRUE.
     * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
     * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = TableMap::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
    {

        if (isset($alreadyDumpedObjects['Campaign'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Campaign'][$this->hashCode()] = true;
        $keys = CampaignTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getUserId(),
            $keys[2] => $this->getBeginDate(),
            $keys[3] => $this->getEndDate(),
            $keys[4] => $this->getCampaignStatusId(),
            $keys[5] => $this->getBalanceId(),
            $keys[6] => $this->getActivityId(),
        );

        $utc = new \DateTimeZone('utc');
        if ($result[$keys[2]] instanceof \DateTime) {
            // When changing timezone we don't want to change existing instances
            $dateTime = clone $result[$keys[2]];
            $result[$keys[2]] = $dateTime->setTimezone($utc)->format('Y-m-d\TH:i:s\Z');
        }

        if ($result[$keys[3]] instanceof \DateTime) {
            // When changing timezone we don't want to change existing instances
            $dateTime = clone $result[$keys[3]];
            $result[$keys[3]] = $dateTime->setTimezone($utc)->format('Y-m-d\TH:i:s\Z');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aCampaignStatus) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'campaignStatus';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'campaign_status';
                        break;
                    default:
                        $key = 'CampaignStatus';
                }

                $result[$key] = $this->aCampaignStatus->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aBalance) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'balance';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'balance';
                        break;
                    default:
                        $key = 'Balance';
                }

                $result[$key] = $this->aBalance->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aActivity) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'activity';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'activity';
                        break;
                    default:
                        $key = 'Activity';
                }

                $result[$key] = $this->aActivity->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collPartnerships) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'partnerships';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'partnerships';
                        break;
                    default:
                        $key = 'Partnerships';
                }

                $result[$key] = $this->collPartnerships->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
        }

        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param  string $name
     * @param  mixed  $value field value
     * @param  string $type The type of fieldname the $name is of:
     *                one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                Defaults to TableMap::TYPE_PHPNAME.
     * @return $this|\Campaign
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = CampaignTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\Campaign
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setUserId($value);
                break;
            case 2:
                $this->setBeginDate($value);
                break;
            case 3:
                $this->setEndDate($value);
                break;
            case 4:
                $this->setCampaignStatusId($value);
                break;
            case 5:
                $this->setBalanceId($value);
                break;
            case 6:
                $this->setActivityId($value);
                break;
        } // switch()

        return $this;
    }

    /**
     * Populates the object using an array.
     *
     * This is particularly useful when populating an object from one of the
     * request arrays (e.g. $_POST).  This method goes through the column
     * names, checking to see whether a matching key exists in populated
     * array. If so the setByName() method is called for that column.
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param      array  $arr     An array to populate the object from.
     * @param      string $keyType The type of keys the array uses.
     * @return void
     */
    public function fromArray($arr, $keyType = TableMap::TYPE_PHPNAME)
    {
        $keys = CampaignTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setUserId($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setBeginDate($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setEndDate($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setCampaignStatusId($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setBalanceId($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setActivityId($arr[$keys[6]]);
        }
    }

     /**
     * Populate the current object from a string, using a given parser format
     * <code>
     * $book = new Book();
     * $book->importFrom('JSON', '{"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param mixed $parser A AbstractParser instance,
     *                       or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param string $data The source data to import from
     * @param string $keyType The type of keys the array uses.
     *
     * @return $this|\Campaign The current object, for fluid interface
     */
    public function importFrom($parser, $data, $keyType = TableMap::TYPE_PHPNAME)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        $this->fromArray($parser->toArray($data), $keyType);

        return $this;
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(CampaignTableMap::DATABASE_NAME);

        if ($this->isColumnModified(CampaignTableMap::COL_ID)) {
            $criteria->add(CampaignTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(CampaignTableMap::COL_USER_ID)) {
            $criteria->add(CampaignTableMap::COL_USER_ID, $this->user_id);
        }
        if ($this->isColumnModified(CampaignTableMap::COL_BEGIN_DATE)) {
            $criteria->add(CampaignTableMap::COL_BEGIN_DATE, $this->begin_date);
        }
        if ($this->isColumnModified(CampaignTableMap::COL_END_DATE)) {
            $criteria->add(CampaignTableMap::COL_END_DATE, $this->end_date);
        }
        if ($this->isColumnModified(CampaignTableMap::COL_CAMPAIGN_STATUS_ID)) {
            $criteria->add(CampaignTableMap::COL_CAMPAIGN_STATUS_ID, $this->campaign_status_id);
        }
        if ($this->isColumnModified(CampaignTableMap::COL_BALANCE_ID)) {
            $criteria->add(CampaignTableMap::COL_BALANCE_ID, $this->balance_id);
        }
        if ($this->isColumnModified(CampaignTableMap::COL_ACTIVITY_ID)) {
            $criteria->add(CampaignTableMap::COL_ACTIVITY_ID, $this->activity_id);
        }

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether or not they have been modified.
     *
     * @throws LogicException if no primary key is defined
     *
     * @return Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria()
    {
        $criteria = ChildCampaignQuery::create();
        $criteria->add(CampaignTableMap::COL_ID, $this->id);

        return $criteria;
    }

    /**
     * If the primary key is not null, return the hashcode of the
     * primary key. Otherwise, return the hash code of the object.
     *
     * @return int Hashcode
     */
    public function hashCode()
    {
        $validPk = null !== $this->getId();

        $validPrimaryKeyFKs = 0;
        $primaryKeyFKs = [];

        if ($validPk) {
            return crc32(json_encode($this->getPrimaryKey(), JSON_UNESCAPED_UNICODE));
        } elseif ($validPrimaryKeyFKs) {
            return crc32(json_encode($primaryKeyFKs, JSON_UNESCAPED_UNICODE));
        }

        return spl_object_hash($this);
    }

    /**
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getId();
    }

    /**
     * Generic method to set the primary key (id column).
     *
     * @param       int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \Campaign (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setUserId($this->getUserId());
        $copyObj->setBeginDate($this->getBeginDate());
        $copyObj->setEndDate($this->getEndDate());
        $copyObj->setCampaignStatusId($this->getCampaignStatusId());
        $copyObj->setBalanceId($this->getBalanceId());
        $copyObj->setActivityId($this->getActivityId());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getPartnerships() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addPartnership($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setId(NULL); // this is a auto-increment column, so set to default value
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param  boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return \Campaign Clone of current object.
     * @throws PropelException
     */
    public function copy($deepCopy = false)
    {
        // we use get_class(), because this might be a subclass
        $clazz = get_class($this);
        $copyObj = new $clazz();
        $this->copyInto($copyObj, $deepCopy);

        return $copyObj;
    }

    /**
     * Declares an association between this object and a ChildCampaignStatus object.
     *
     * @param  ChildCampaignStatus $v
     * @return $this|\Campaign The current object (for fluent API support)
     * @throws PropelException
     */
    public function setCampaignStatus(ChildCampaignStatus $v = null)
    {
        if ($v === null) {
            $this->setCampaignStatusId(NULL);
        } else {
            $this->setCampaignStatusId($v->getId());
        }

        $this->aCampaignStatus = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildCampaignStatus object, it will not be re-added.
        if ($v !== null) {
            $v->addCampaign($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildCampaignStatus object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildCampaignStatus The associated ChildCampaignStatus object.
     * @throws PropelException
     */
    public function getCampaignStatus(ConnectionInterface $con = null)
    {
        if ($this->aCampaignStatus === null && ($this->campaign_status_id !== null)) {
            $this->aCampaignStatus = ChildCampaignStatusQuery::create()->findPk($this->campaign_status_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aCampaignStatus->addCampaigns($this);
             */
        }

        return $this->aCampaignStatus;
    }

    /**
     * Declares an association between this object and a ChildBalance object.
     *
     * @param  ChildBalance $v
     * @return $this|\Campaign The current object (for fluent API support)
     * @throws PropelException
     */
    public function setBalance(ChildBalance $v = null)
    {
        if ($v === null) {
            $this->setBalanceId(NULL);
        } else {
            $this->setBalanceId($v->getId());
        }

        $this->aBalance = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildBalance object, it will not be re-added.
        if ($v !== null) {
            $v->addCampaign($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildBalance object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildBalance The associated ChildBalance object.
     * @throws PropelException
     */
    public function getBalance(ConnectionInterface $con = null)
    {
        if ($this->aBalance === null && ($this->balance_id !== null)) {
            $this->aBalance = ChildBalanceQuery::create()->findPk($this->balance_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aBalance->addCampaigns($this);
             */
        }

        return $this->aBalance;
    }

    /**
     * Declares an association between this object and a ChildActivity object.
     *
     * @param  ChildActivity $v
     * @return $this|\Campaign The current object (for fluent API support)
     * @throws PropelException
     */
    public function setActivity(ChildActivity $v = null)
    {
        if ($v === null) {
            $this->setActivityId(NULL);
        } else {
            $this->setActivityId($v->getId());
        }

        $this->aActivity = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildActivity object, it will not be re-added.
        if ($v !== null) {
            $v->addCampaign($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildActivity object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildActivity The associated ChildActivity object.
     * @throws PropelException
     */
    public function getActivity(ConnectionInterface $con = null)
    {
        if ($this->aActivity === null && ($this->activity_id !== null)) {
            $this->aActivity = ChildActivityQuery::create()->findPk($this->activity_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aActivity->addCampaigns($this);
             */
        }

        return $this->aActivity;
    }


    /**
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param      string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName)
    {
        if ('Partnership' == $relationName) {
            return $this->initPartnerships();
        }
    }

    /**
     * Clears out the collPartnerships collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addPartnerships()
     */
    public function clearPartnerships()
    {
        $this->collPartnerships = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collPartnerships collection loaded partially.
     */
    public function resetPartialPartnerships($v = true)
    {
        $this->collPartnershipsPartial = $v;
    }

    /**
     * Initializes the collPartnerships collection.
     *
     * By default this just sets the collPartnerships collection to an empty array (like clearcollPartnerships());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initPartnerships($overrideExisting = true)
    {
        if (null !== $this->collPartnerships && !$overrideExisting) {
            return;
        }
        $this->collPartnerships = new ObjectCollection();
        $this->collPartnerships->setModel('\Partnership');
    }

    /**
     * Gets an array of ChildPartnership objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildCampaign is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildPartnership[] List of ChildPartnership objects
     * @throws PropelException
     */
    public function getPartnerships(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collPartnershipsPartial && !$this->isNew();
        if (null === $this->collPartnerships || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collPartnerships) {
                // return empty collection
                $this->initPartnerships();
            } else {
                $collPartnerships = ChildPartnershipQuery::create(null, $criteria)
                    ->filterByCampaign($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collPartnershipsPartial && count($collPartnerships)) {
                        $this->initPartnerships(false);

                        foreach ($collPartnerships as $obj) {
                            if (false == $this->collPartnerships->contains($obj)) {
                                $this->collPartnerships->append($obj);
                            }
                        }

                        $this->collPartnershipsPartial = true;
                    }

                    return $collPartnerships;
                }

                if ($partial && $this->collPartnerships) {
                    foreach ($this->collPartnerships as $obj) {
                        if ($obj->isNew()) {
                            $collPartnerships[] = $obj;
                        }
                    }
                }

                $this->collPartnerships = $collPartnerships;
                $this->collPartnershipsPartial = false;
            }
        }

        return $this->collPartnerships;
    }

    /**
     * Sets a collection of ChildPartnership objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $partnerships A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildCampaign The current object (for fluent API support)
     */
    public function setPartnerships(Collection $partnerships, ConnectionInterface $con = null)
    {
        /** @var ChildPartnership[] $partnershipsToDelete */
        $partnershipsToDelete = $this->getPartnerships(new Criteria(), $con)->diff($partnerships);


        $this->partnershipsScheduledForDeletion = $partnershipsToDelete;

        foreach ($partnershipsToDelete as $partnershipRemoved) {
            $partnershipRemoved->setCampaign(null);
        }

        $this->collPartnerships = null;
        foreach ($partnerships as $partnership) {
            $this->addPartnership($partnership);
        }

        $this->collPartnerships = $partnerships;
        $this->collPartnershipsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Partnership objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Partnership objects.
     * @throws PropelException
     */
    public function countPartnerships(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collPartnershipsPartial && !$this->isNew();
        if (null === $this->collPartnerships || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collPartnerships) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getPartnerships());
            }

            $query = ChildPartnershipQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByCampaign($this)
                ->count($con);
        }

        return count($this->collPartnerships);
    }

    /**
     * Method called to associate a ChildPartnership object to this object
     * through the ChildPartnership foreign key attribute.
     *
     * @param  ChildPartnership $l ChildPartnership
     * @return $this|\Campaign The current object (for fluent API support)
     */
    public function addPartnership(ChildPartnership $l)
    {
        if ($this->collPartnerships === null) {
            $this->initPartnerships();
            $this->collPartnershipsPartial = true;
        }

        if (!$this->collPartnerships->contains($l)) {
            $this->doAddPartnership($l);
        }

        return $this;
    }

    /**
     * @param ChildPartnership $partnership The ChildPartnership object to add.
     */
    protected function doAddPartnership(ChildPartnership $partnership)
    {
        $this->collPartnerships[]= $partnership;
        $partnership->setCampaign($this);
    }

    /**
     * @param  ChildPartnership $partnership The ChildPartnership object to remove.
     * @return $this|ChildCampaign The current object (for fluent API support)
     */
    public function removePartnership(ChildPartnership $partnership)
    {
        if ($this->getPartnerships()->contains($partnership)) {
            $pos = $this->collPartnerships->search($partnership);
            $this->collPartnerships->remove($pos);
            if (null === $this->partnershipsScheduledForDeletion) {
                $this->partnershipsScheduledForDeletion = clone $this->collPartnerships;
                $this->partnershipsScheduledForDeletion->clear();
            }
            $this->partnershipsScheduledForDeletion[]= $partnership;
            $partnership->setCampaign(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Campaign is new, it will return
     * an empty collection; or if this Campaign has previously
     * been saved, it will retrieve related Partnerships from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Campaign.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildPartnership[] List of ChildPartnership objects
     */
    public function getPartnershipsJoinUserRelatedByUserId(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildPartnershipQuery::create(null, $criteria);
        $query->joinWith('UserRelatedByUserId', $joinBehavior);

        return $this->getPartnerships($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Campaign is new, it will return
     * an empty collection; or if this Campaign has previously
     * been saved, it will retrieve related Partnerships from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Campaign.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildPartnership[] List of ChildPartnership objects
     */
    public function getPartnershipsJoinUserRelatedByPartnerId(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildPartnershipQuery::create(null, $criteria);
        $query->joinWith('UserRelatedByPartnerId', $joinBehavior);

        return $this->getPartnerships($query, $con);
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aCampaignStatus) {
            $this->aCampaignStatus->removeCampaign($this);
        }
        if (null !== $this->aBalance) {
            $this->aBalance->removeCampaign($this);
        }
        if (null !== $this->aActivity) {
            $this->aActivity->removeCampaign($this);
        }
        $this->id = null;
        $this->user_id = null;
        $this->begin_date = null;
        $this->end_date = null;
        $this->campaign_status_id = null;
        $this->balance_id = null;
        $this->activity_id = null;
        $this->alreadyInSave = false;
        $this->clearAllReferences();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);
    }

    /**
     * Resets all references and back-references to other model objects or collections of model objects.
     *
     * This method is used to reset all php object references (not the actual reference in the database).
     * Necessary for object serialisation.
     *
     * @param      boolean $deep Whether to also clear the references on all referrer objects.
     */
    public function clearAllReferences($deep = false)
    {
        if ($deep) {
            if ($this->collPartnerships) {
                foreach ($this->collPartnerships as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collPartnerships = null;
        $this->aCampaignStatus = null;
        $this->aBalance = null;
        $this->aActivity = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(CampaignTableMap::DEFAULT_STRING_FORMAT);
    }

    /**
     * Code to be run before persisting the object
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preSave(ConnectionInterface $con = null)
    {
        return true;
    }

    /**
     * Code to be run after persisting the object
     * @param ConnectionInterface $con
     */
    public function postSave(ConnectionInterface $con = null)
    {

    }

    /**
     * Code to be run before inserting to database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preInsert(ConnectionInterface $con = null)
    {
        return true;
    }

    /**
     * Code to be run after inserting to database
     * @param ConnectionInterface $con
     */
    public function postInsert(ConnectionInterface $con = null)
    {

    }

    /**
     * Code to be run before updating the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preUpdate(ConnectionInterface $con = null)
    {
        return true;
    }

    /**
     * Code to be run after updating the object in database
     * @param ConnectionInterface $con
     */
    public function postUpdate(ConnectionInterface $con = null)
    {

    }

    /**
     * Code to be run before deleting the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preDelete(ConnectionInterface $con = null)
    {
        return true;
    }

    /**
     * Code to be run after deleting the object in database
     * @param ConnectionInterface $con
     */
    public function postDelete(ConnectionInterface $con = null)
    {

    }


    /**
     * Derived method to catches calls to undefined methods.
     *
     * Provides magic import/export method support (fromXML()/toXML(), fromYAML()/toYAML(), etc.).
     * Allows to define default __call() behavior if you overwrite __call()
     *
     * @param string $name
     * @param mixed  $params
     *
     * @return array|string
     */
    public function __call($name, $params)
    {
        if (0 === strpos($name, 'get')) {
            $virtualColumn = substr($name, 3);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }

            $virtualColumn = lcfirst($virtualColumn);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }
        }

        if (0 === strpos($name, 'from')) {
            $format = substr($name, 4);

            return $this->importFrom($format, reset($params));
        }

        if (0 === strpos($name, 'to')) {
            $format = substr($name, 2);
            $includeLazyLoadColumns = isset($params[0]) ? $params[0] : true;

            return $this->exportTo($format, $includeLazyLoadColumns);
        }

        throw new BadMethodCallException(sprintf('Call to undefined method: %s.', $name));
    }

}
