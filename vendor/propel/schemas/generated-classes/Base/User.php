<?php

namespace Base;

use \Partnership as ChildPartnership;
use \PartnershipQuery as ChildPartnershipQuery;
use \User as ChildUser;
use \UserQuery as ChildUserQuery;
use \DateTime;
use \Exception;
use \PDO;
use Map\UserTableMap;
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
 * Base class that represents a row from the 'user' table.
 *
 *
 *
* @package    propel.generator..Base
*/
abstract class User implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Map\\UserTableMap';


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
     * The value for the username field.
     * @var        string
     */
    protected $username;

    /**
     * The value for the first_name field.
     * @var        string
     */
    protected $first_name;

    /**
     * The value for the last_name field.
     * @var        string
     */
    protected $last_name;

    /**
     * The value for the last_active field.
     * @var        \DateTime
     */
    protected $last_active;

    /**
     * The value for the email field.
     * @var        string
     */
    protected $email;

    /**
     * The value for the score field.
     * @var        int
     */
    protected $score;

    /**
     * The value for the token field.
     * @var        string
     */
    protected $token;

    /**
     * @var        ObjectCollection|ChildPartnership[] Collection to store aggregation of ChildPartnership objects.
     */
    protected $collPartnershipsRelatedByUserId;
    protected $collPartnershipsRelatedByUserIdPartial;

    /**
     * @var        ObjectCollection|ChildPartnership[] Collection to store aggregation of ChildPartnership objects.
     */
    protected $collPartnershipsRelatedByPartnerId;
    protected $collPartnershipsRelatedByPartnerIdPartial;

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
    protected $partnershipsRelatedByUserIdScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildPartnership[]
     */
    protected $partnershipsRelatedByPartnerIdScheduledForDeletion = null;

    /**
     * Initializes internal state of Base\User object.
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
     * Compares this with another <code>User</code> instance.  If
     * <code>obj</code> is an instance of <code>User</code>, delegates to
     * <code>equals(User)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|User The current object, for fluid interface
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
     * Get the [username] column value.
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Get the [first_name] column value.
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->first_name;
    }

    /**
     * Get the [last_name] column value.
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->last_name;
    }

    /**
     * Get the [optionally formatted] temporal [last_active] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getLastActive($format = NULL)
    {
        if ($format === null) {
            return $this->last_active;
        } else {
            return $this->last_active instanceof \DateTime ? $this->last_active->format($format) : null;
        }
    }

    /**
     * Get the [email] column value.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Get the [score] column value.
     *
     * @return int
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * Get the [token] column value.
     *
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Set the value of [id] column.
     *
     * @param int $v new value
     * @return $this|\User The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[UserTableMap::COL_ID] = true;
        }

        return $this;
    } // setId()

    /**
     * Set the value of [username] column.
     *
     * @param string $v new value
     * @return $this|\User The current object (for fluent API support)
     */
    public function setUsername($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->username !== $v) {
            $this->username = $v;
            $this->modifiedColumns[UserTableMap::COL_USERNAME] = true;
        }

        return $this;
    } // setUsername()

    /**
     * Set the value of [first_name] column.
     *
     * @param string $v new value
     * @return $this|\User The current object (for fluent API support)
     */
    public function setFirstName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->first_name !== $v) {
            $this->first_name = $v;
            $this->modifiedColumns[UserTableMap::COL_FIRST_NAME] = true;
        }

        return $this;
    } // setFirstName()

    /**
     * Set the value of [last_name] column.
     *
     * @param string $v new value
     * @return $this|\User The current object (for fluent API support)
     */
    public function setLastName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->last_name !== $v) {
            $this->last_name = $v;
            $this->modifiedColumns[UserTableMap::COL_LAST_NAME] = true;
        }

        return $this;
    } // setLastName()

    /**
     * Sets the value of [last_active] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\User The current object (for fluent API support)
     */
    public function setLastActive($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->last_active !== null || $dt !== null) {
            if ($dt !== $this->last_active) {
                $this->last_active = $dt;
                $this->modifiedColumns[UserTableMap::COL_LAST_ACTIVE] = true;
            }
        } // if either are not null

        return $this;
    } // setLastActive()

    /**
     * Set the value of [email] column.
     *
     * @param string $v new value
     * @return $this|\User The current object (for fluent API support)
     */
    public function setEmail($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->email !== $v) {
            $this->email = $v;
            $this->modifiedColumns[UserTableMap::COL_EMAIL] = true;
        }

        return $this;
    } // setEmail()

    /**
     * Set the value of [score] column.
     *
     * @param int $v new value
     * @return $this|\User The current object (for fluent API support)
     */
    public function setScore($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->score !== $v) {
            $this->score = $v;
            $this->modifiedColumns[UserTableMap::COL_SCORE] = true;
        }

        return $this;
    } // setScore()

    /**
     * Set the value of [token] column.
     *
     * @param string $v new value
     * @return $this|\User The current object (for fluent API support)
     */
    public function setToken($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->token !== $v) {
            $this->token = $v;
            $this->modifiedColumns[UserTableMap::COL_TOKEN] = true;
        }

        return $this;
    } // setToken()

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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : UserTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : UserTableMap::translateFieldName('Username', TableMap::TYPE_PHPNAME, $indexType)];
            $this->username = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : UserTableMap::translateFieldName('FirstName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->first_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : UserTableMap::translateFieldName('LastName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->last_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : UserTableMap::translateFieldName('LastActive', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->last_active = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : UserTableMap::translateFieldName('Email', TableMap::TYPE_PHPNAME, $indexType)];
            $this->email = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : UserTableMap::translateFieldName('Score', TableMap::TYPE_PHPNAME, $indexType)];
            $this->score = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : UserTableMap::translateFieldName('Token', TableMap::TYPE_PHPNAME, $indexType)];
            $this->token = (null !== $col) ? (string) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 8; // 8 = UserTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\User'), 0, $e);
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
            $con = Propel::getServiceContainer()->getReadConnection(UserTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildUserQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collPartnershipsRelatedByUserId = null;

            $this->collPartnershipsRelatedByPartnerId = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see User::setDeleted()
     * @see User::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(UserTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildUserQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(UserTableMap::DATABASE_NAME);
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
                UserTableMap::addInstanceToPool($this);
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

            if ($this->partnershipsRelatedByUserIdScheduledForDeletion !== null) {
                if (!$this->partnershipsRelatedByUserIdScheduledForDeletion->isEmpty()) {
                    foreach ($this->partnershipsRelatedByUserIdScheduledForDeletion as $partnershipRelatedByUserId) {
                        // need to save related object because we set the relation to null
                        $partnershipRelatedByUserId->save($con);
                    }
                    $this->partnershipsRelatedByUserIdScheduledForDeletion = null;
                }
            }

            if ($this->collPartnershipsRelatedByUserId !== null) {
                foreach ($this->collPartnershipsRelatedByUserId as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->partnershipsRelatedByPartnerIdScheduledForDeletion !== null) {
                if (!$this->partnershipsRelatedByPartnerIdScheduledForDeletion->isEmpty()) {
                    foreach ($this->partnershipsRelatedByPartnerIdScheduledForDeletion as $partnershipRelatedByPartnerId) {
                        // need to save related object because we set the relation to null
                        $partnershipRelatedByPartnerId->save($con);
                    }
                    $this->partnershipsRelatedByPartnerIdScheduledForDeletion = null;
                }
            }

            if ($this->collPartnershipsRelatedByPartnerId !== null) {
                foreach ($this->collPartnershipsRelatedByPartnerId as $referrerFK) {
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

        $this->modifiedColumns[UserTableMap::COL_ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . UserTableMap::COL_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(UserTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = 'id';
        }
        if ($this->isColumnModified(UserTableMap::COL_USERNAME)) {
            $modifiedColumns[':p' . $index++]  = 'username';
        }
        if ($this->isColumnModified(UserTableMap::COL_FIRST_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'first_name';
        }
        if ($this->isColumnModified(UserTableMap::COL_LAST_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'last_name';
        }
        if ($this->isColumnModified(UserTableMap::COL_LAST_ACTIVE)) {
            $modifiedColumns[':p' . $index++]  = 'last_active';
        }
        if ($this->isColumnModified(UserTableMap::COL_EMAIL)) {
            $modifiedColumns[':p' . $index++]  = 'email';
        }
        if ($this->isColumnModified(UserTableMap::COL_SCORE)) {
            $modifiedColumns[':p' . $index++]  = 'score';
        }
        if ($this->isColumnModified(UserTableMap::COL_TOKEN)) {
            $modifiedColumns[':p' . $index++]  = 'token';
        }

        $sql = sprintf(
            'INSERT INTO user (%s) VALUES (%s)',
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
                    case 'username':
                        $stmt->bindValue($identifier, $this->username, PDO::PARAM_STR);
                        break;
                    case 'first_name':
                        $stmt->bindValue($identifier, $this->first_name, PDO::PARAM_STR);
                        break;
                    case 'last_name':
                        $stmt->bindValue($identifier, $this->last_name, PDO::PARAM_STR);
                        break;
                    case 'last_active':
                        $stmt->bindValue($identifier, $this->last_active ? $this->last_active->format("Y-m-d H:i:s") : null, PDO::PARAM_STR);
                        break;
                    case 'email':
                        $stmt->bindValue($identifier, $this->email, PDO::PARAM_STR);
                        break;
                    case 'score':
                        $stmt->bindValue($identifier, $this->score, PDO::PARAM_INT);
                        break;
                    case 'token':
                        $stmt->bindValue($identifier, $this->token, PDO::PARAM_STR);
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
        $pos = UserTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getUsername();
                break;
            case 2:
                return $this->getFirstName();
                break;
            case 3:
                return $this->getLastName();
                break;
            case 4:
                return $this->getLastActive();
                break;
            case 5:
                return $this->getEmail();
                break;
            case 6:
                return $this->getScore();
                break;
            case 7:
                return $this->getToken();
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

        if (isset($alreadyDumpedObjects['User'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['User'][$this->hashCode()] = true;
        $keys = UserTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getUsername(),
            $keys[2] => $this->getFirstName(),
            $keys[3] => $this->getLastName(),
            $keys[4] => $this->getLastActive(),
            $keys[5] => $this->getEmail(),
            $keys[6] => $this->getScore(),
            $keys[7] => $this->getToken(),
        );

        $utc = new \DateTimeZone('utc');
        if ($result[$keys[4]] instanceof \DateTime) {
            // When changing timezone we don't want to change existing instances
            $dateTime = clone $result[$keys[4]];
            $result[$keys[4]] = $dateTime->setTimezone($utc)->format('Y-m-d\TH:i:s\Z');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->collPartnershipsRelatedByUserId) {

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

                $result[$key] = $this->collPartnershipsRelatedByUserId->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collPartnershipsRelatedByPartnerId) {

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

                $result[$key] = $this->collPartnershipsRelatedByPartnerId->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
     * @return $this|\User
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = UserTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\User
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setUsername($value);
                break;
            case 2:
                $this->setFirstName($value);
                break;
            case 3:
                $this->setLastName($value);
                break;
            case 4:
                $this->setLastActive($value);
                break;
            case 5:
                $this->setEmail($value);
                break;
            case 6:
                $this->setScore($value);
                break;
            case 7:
                $this->setToken($value);
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
        $keys = UserTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setUsername($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setFirstName($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setLastName($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setLastActive($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setEmail($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setScore($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setToken($arr[$keys[7]]);
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
     * @return $this|\User The current object, for fluid interface
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
        $criteria = new Criteria(UserTableMap::DATABASE_NAME);

        if ($this->isColumnModified(UserTableMap::COL_ID)) {
            $criteria->add(UserTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(UserTableMap::COL_USERNAME)) {
            $criteria->add(UserTableMap::COL_USERNAME, $this->username);
        }
        if ($this->isColumnModified(UserTableMap::COL_FIRST_NAME)) {
            $criteria->add(UserTableMap::COL_FIRST_NAME, $this->first_name);
        }
        if ($this->isColumnModified(UserTableMap::COL_LAST_NAME)) {
            $criteria->add(UserTableMap::COL_LAST_NAME, $this->last_name);
        }
        if ($this->isColumnModified(UserTableMap::COL_LAST_ACTIVE)) {
            $criteria->add(UserTableMap::COL_LAST_ACTIVE, $this->last_active);
        }
        if ($this->isColumnModified(UserTableMap::COL_EMAIL)) {
            $criteria->add(UserTableMap::COL_EMAIL, $this->email);
        }
        if ($this->isColumnModified(UserTableMap::COL_SCORE)) {
            $criteria->add(UserTableMap::COL_SCORE, $this->score);
        }
        if ($this->isColumnModified(UserTableMap::COL_TOKEN)) {
            $criteria->add(UserTableMap::COL_TOKEN, $this->token);
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
        $criteria = ChildUserQuery::create();
        $criteria->add(UserTableMap::COL_ID, $this->id);

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
     * @param      object $copyObj An object of \User (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setUsername($this->getUsername());
        $copyObj->setFirstName($this->getFirstName());
        $copyObj->setLastName($this->getLastName());
        $copyObj->setLastActive($this->getLastActive());
        $copyObj->setEmail($this->getEmail());
        $copyObj->setScore($this->getScore());
        $copyObj->setToken($this->getToken());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getPartnershipsRelatedByUserId() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addPartnershipRelatedByUserId($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getPartnershipsRelatedByPartnerId() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addPartnershipRelatedByPartnerId($relObj->copy($deepCopy));
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
     * @return \User Clone of current object.
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
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param      string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName)
    {
        if ('PartnershipRelatedByUserId' == $relationName) {
            return $this->initPartnershipsRelatedByUserId();
        }
        if ('PartnershipRelatedByPartnerId' == $relationName) {
            return $this->initPartnershipsRelatedByPartnerId();
        }
    }

    /**
     * Clears out the collPartnershipsRelatedByUserId collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addPartnershipsRelatedByUserId()
     */
    public function clearPartnershipsRelatedByUserId()
    {
        $this->collPartnershipsRelatedByUserId = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collPartnershipsRelatedByUserId collection loaded partially.
     */
    public function resetPartialPartnershipsRelatedByUserId($v = true)
    {
        $this->collPartnershipsRelatedByUserIdPartial = $v;
    }

    /**
     * Initializes the collPartnershipsRelatedByUserId collection.
     *
     * By default this just sets the collPartnershipsRelatedByUserId collection to an empty array (like clearcollPartnershipsRelatedByUserId());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initPartnershipsRelatedByUserId($overrideExisting = true)
    {
        if (null !== $this->collPartnershipsRelatedByUserId && !$overrideExisting) {
            return;
        }
        $this->collPartnershipsRelatedByUserId = new ObjectCollection();
        $this->collPartnershipsRelatedByUserId->setModel('\Partnership');
    }

    /**
     * Gets an array of ChildPartnership objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildUser is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildPartnership[] List of ChildPartnership objects
     * @throws PropelException
     */
    public function getPartnershipsRelatedByUserId(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collPartnershipsRelatedByUserIdPartial && !$this->isNew();
        if (null === $this->collPartnershipsRelatedByUserId || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collPartnershipsRelatedByUserId) {
                // return empty collection
                $this->initPartnershipsRelatedByUserId();
            } else {
                $collPartnershipsRelatedByUserId = ChildPartnershipQuery::create(null, $criteria)
                    ->filterByUserRelatedByUserId($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collPartnershipsRelatedByUserIdPartial && count($collPartnershipsRelatedByUserId)) {
                        $this->initPartnershipsRelatedByUserId(false);

                        foreach ($collPartnershipsRelatedByUserId as $obj) {
                            if (false == $this->collPartnershipsRelatedByUserId->contains($obj)) {
                                $this->collPartnershipsRelatedByUserId->append($obj);
                            }
                        }

                        $this->collPartnershipsRelatedByUserIdPartial = true;
                    }

                    return $collPartnershipsRelatedByUserId;
                }

                if ($partial && $this->collPartnershipsRelatedByUserId) {
                    foreach ($this->collPartnershipsRelatedByUserId as $obj) {
                        if ($obj->isNew()) {
                            $collPartnershipsRelatedByUserId[] = $obj;
                        }
                    }
                }

                $this->collPartnershipsRelatedByUserId = $collPartnershipsRelatedByUserId;
                $this->collPartnershipsRelatedByUserIdPartial = false;
            }
        }

        return $this->collPartnershipsRelatedByUserId;
    }

    /**
     * Sets a collection of ChildPartnership objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $partnershipsRelatedByUserId A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildUser The current object (for fluent API support)
     */
    public function setPartnershipsRelatedByUserId(Collection $partnershipsRelatedByUserId, ConnectionInterface $con = null)
    {
        /** @var ChildPartnership[] $partnershipsRelatedByUserIdToDelete */
        $partnershipsRelatedByUserIdToDelete = $this->getPartnershipsRelatedByUserId(new Criteria(), $con)->diff($partnershipsRelatedByUserId);


        $this->partnershipsRelatedByUserIdScheduledForDeletion = $partnershipsRelatedByUserIdToDelete;

        foreach ($partnershipsRelatedByUserIdToDelete as $partnershipRelatedByUserIdRemoved) {
            $partnershipRelatedByUserIdRemoved->setUserRelatedByUserId(null);
        }

        $this->collPartnershipsRelatedByUserId = null;
        foreach ($partnershipsRelatedByUserId as $partnershipRelatedByUserId) {
            $this->addPartnershipRelatedByUserId($partnershipRelatedByUserId);
        }

        $this->collPartnershipsRelatedByUserId = $partnershipsRelatedByUserId;
        $this->collPartnershipsRelatedByUserIdPartial = false;

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
    public function countPartnershipsRelatedByUserId(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collPartnershipsRelatedByUserIdPartial && !$this->isNew();
        if (null === $this->collPartnershipsRelatedByUserId || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collPartnershipsRelatedByUserId) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getPartnershipsRelatedByUserId());
            }

            $query = ChildPartnershipQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByUserRelatedByUserId($this)
                ->count($con);
        }

        return count($this->collPartnershipsRelatedByUserId);
    }

    /**
     * Method called to associate a ChildPartnership object to this object
     * through the ChildPartnership foreign key attribute.
     *
     * @param  ChildPartnership $l ChildPartnership
     * @return $this|\User The current object (for fluent API support)
     */
    public function addPartnershipRelatedByUserId(ChildPartnership $l)
    {
        if ($this->collPartnershipsRelatedByUserId === null) {
            $this->initPartnershipsRelatedByUserId();
            $this->collPartnershipsRelatedByUserIdPartial = true;
        }

        if (!$this->collPartnershipsRelatedByUserId->contains($l)) {
            $this->doAddPartnershipRelatedByUserId($l);
        }

        return $this;
    }

    /**
     * @param ChildPartnership $partnershipRelatedByUserId The ChildPartnership object to add.
     */
    protected function doAddPartnershipRelatedByUserId(ChildPartnership $partnershipRelatedByUserId)
    {
        $this->collPartnershipsRelatedByUserId[]= $partnershipRelatedByUserId;
        $partnershipRelatedByUserId->setUserRelatedByUserId($this);
    }

    /**
     * @param  ChildPartnership $partnershipRelatedByUserId The ChildPartnership object to remove.
     * @return $this|ChildUser The current object (for fluent API support)
     */
    public function removePartnershipRelatedByUserId(ChildPartnership $partnershipRelatedByUserId)
    {
        if ($this->getPartnershipsRelatedByUserId()->contains($partnershipRelatedByUserId)) {
            $pos = $this->collPartnershipsRelatedByUserId->search($partnershipRelatedByUserId);
            $this->collPartnershipsRelatedByUserId->remove($pos);
            if (null === $this->partnershipsRelatedByUserIdScheduledForDeletion) {
                $this->partnershipsRelatedByUserIdScheduledForDeletion = clone $this->collPartnershipsRelatedByUserId;
                $this->partnershipsRelatedByUserIdScheduledForDeletion->clear();
            }
            $this->partnershipsRelatedByUserIdScheduledForDeletion[]= $partnershipRelatedByUserId;
            $partnershipRelatedByUserId->setUserRelatedByUserId(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this User is new, it will return
     * an empty collection; or if this User has previously
     * been saved, it will retrieve related PartnershipsRelatedByUserId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in User.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildPartnership[] List of ChildPartnership objects
     */
    public function getPartnershipsRelatedByUserIdJoinCampaign(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildPartnershipQuery::create(null, $criteria);
        $query->joinWith('Campaign', $joinBehavior);

        return $this->getPartnershipsRelatedByUserId($query, $con);
    }

    /**
     * Clears out the collPartnershipsRelatedByPartnerId collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addPartnershipsRelatedByPartnerId()
     */
    public function clearPartnershipsRelatedByPartnerId()
    {
        $this->collPartnershipsRelatedByPartnerId = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collPartnershipsRelatedByPartnerId collection loaded partially.
     */
    public function resetPartialPartnershipsRelatedByPartnerId($v = true)
    {
        $this->collPartnershipsRelatedByPartnerIdPartial = $v;
    }

    /**
     * Initializes the collPartnershipsRelatedByPartnerId collection.
     *
     * By default this just sets the collPartnershipsRelatedByPartnerId collection to an empty array (like clearcollPartnershipsRelatedByPartnerId());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initPartnershipsRelatedByPartnerId($overrideExisting = true)
    {
        if (null !== $this->collPartnershipsRelatedByPartnerId && !$overrideExisting) {
            return;
        }
        $this->collPartnershipsRelatedByPartnerId = new ObjectCollection();
        $this->collPartnershipsRelatedByPartnerId->setModel('\Partnership');
    }

    /**
     * Gets an array of ChildPartnership objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildUser is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildPartnership[] List of ChildPartnership objects
     * @throws PropelException
     */
    public function getPartnershipsRelatedByPartnerId(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collPartnershipsRelatedByPartnerIdPartial && !$this->isNew();
        if (null === $this->collPartnershipsRelatedByPartnerId || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collPartnershipsRelatedByPartnerId) {
                // return empty collection
                $this->initPartnershipsRelatedByPartnerId();
            } else {
                $collPartnershipsRelatedByPartnerId = ChildPartnershipQuery::create(null, $criteria)
                    ->filterByUserRelatedByPartnerId($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collPartnershipsRelatedByPartnerIdPartial && count($collPartnershipsRelatedByPartnerId)) {
                        $this->initPartnershipsRelatedByPartnerId(false);

                        foreach ($collPartnershipsRelatedByPartnerId as $obj) {
                            if (false == $this->collPartnershipsRelatedByPartnerId->contains($obj)) {
                                $this->collPartnershipsRelatedByPartnerId->append($obj);
                            }
                        }

                        $this->collPartnershipsRelatedByPartnerIdPartial = true;
                    }

                    return $collPartnershipsRelatedByPartnerId;
                }

                if ($partial && $this->collPartnershipsRelatedByPartnerId) {
                    foreach ($this->collPartnershipsRelatedByPartnerId as $obj) {
                        if ($obj->isNew()) {
                            $collPartnershipsRelatedByPartnerId[] = $obj;
                        }
                    }
                }

                $this->collPartnershipsRelatedByPartnerId = $collPartnershipsRelatedByPartnerId;
                $this->collPartnershipsRelatedByPartnerIdPartial = false;
            }
        }

        return $this->collPartnershipsRelatedByPartnerId;
    }

    /**
     * Sets a collection of ChildPartnership objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $partnershipsRelatedByPartnerId A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildUser The current object (for fluent API support)
     */
    public function setPartnershipsRelatedByPartnerId(Collection $partnershipsRelatedByPartnerId, ConnectionInterface $con = null)
    {
        /** @var ChildPartnership[] $partnershipsRelatedByPartnerIdToDelete */
        $partnershipsRelatedByPartnerIdToDelete = $this->getPartnershipsRelatedByPartnerId(new Criteria(), $con)->diff($partnershipsRelatedByPartnerId);


        $this->partnershipsRelatedByPartnerIdScheduledForDeletion = $partnershipsRelatedByPartnerIdToDelete;

        foreach ($partnershipsRelatedByPartnerIdToDelete as $partnershipRelatedByPartnerIdRemoved) {
            $partnershipRelatedByPartnerIdRemoved->setUserRelatedByPartnerId(null);
        }

        $this->collPartnershipsRelatedByPartnerId = null;
        foreach ($partnershipsRelatedByPartnerId as $partnershipRelatedByPartnerId) {
            $this->addPartnershipRelatedByPartnerId($partnershipRelatedByPartnerId);
        }

        $this->collPartnershipsRelatedByPartnerId = $partnershipsRelatedByPartnerId;
        $this->collPartnershipsRelatedByPartnerIdPartial = false;

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
    public function countPartnershipsRelatedByPartnerId(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collPartnershipsRelatedByPartnerIdPartial && !$this->isNew();
        if (null === $this->collPartnershipsRelatedByPartnerId || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collPartnershipsRelatedByPartnerId) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getPartnershipsRelatedByPartnerId());
            }

            $query = ChildPartnershipQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByUserRelatedByPartnerId($this)
                ->count($con);
        }

        return count($this->collPartnershipsRelatedByPartnerId);
    }

    /**
     * Method called to associate a ChildPartnership object to this object
     * through the ChildPartnership foreign key attribute.
     *
     * @param  ChildPartnership $l ChildPartnership
     * @return $this|\User The current object (for fluent API support)
     */
    public function addPartnershipRelatedByPartnerId(ChildPartnership $l)
    {
        if ($this->collPartnershipsRelatedByPartnerId === null) {
            $this->initPartnershipsRelatedByPartnerId();
            $this->collPartnershipsRelatedByPartnerIdPartial = true;
        }

        if (!$this->collPartnershipsRelatedByPartnerId->contains($l)) {
            $this->doAddPartnershipRelatedByPartnerId($l);
        }

        return $this;
    }

    /**
     * @param ChildPartnership $partnershipRelatedByPartnerId The ChildPartnership object to add.
     */
    protected function doAddPartnershipRelatedByPartnerId(ChildPartnership $partnershipRelatedByPartnerId)
    {
        $this->collPartnershipsRelatedByPartnerId[]= $partnershipRelatedByPartnerId;
        $partnershipRelatedByPartnerId->setUserRelatedByPartnerId($this);
    }

    /**
     * @param  ChildPartnership $partnershipRelatedByPartnerId The ChildPartnership object to remove.
     * @return $this|ChildUser The current object (for fluent API support)
     */
    public function removePartnershipRelatedByPartnerId(ChildPartnership $partnershipRelatedByPartnerId)
    {
        if ($this->getPartnershipsRelatedByPartnerId()->contains($partnershipRelatedByPartnerId)) {
            $pos = $this->collPartnershipsRelatedByPartnerId->search($partnershipRelatedByPartnerId);
            $this->collPartnershipsRelatedByPartnerId->remove($pos);
            if (null === $this->partnershipsRelatedByPartnerIdScheduledForDeletion) {
                $this->partnershipsRelatedByPartnerIdScheduledForDeletion = clone $this->collPartnershipsRelatedByPartnerId;
                $this->partnershipsRelatedByPartnerIdScheduledForDeletion->clear();
            }
            $this->partnershipsRelatedByPartnerIdScheduledForDeletion[]= $partnershipRelatedByPartnerId;
            $partnershipRelatedByPartnerId->setUserRelatedByPartnerId(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this User is new, it will return
     * an empty collection; or if this User has previously
     * been saved, it will retrieve related PartnershipsRelatedByPartnerId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in User.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildPartnership[] List of ChildPartnership objects
     */
    public function getPartnershipsRelatedByPartnerIdJoinCampaign(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildPartnershipQuery::create(null, $criteria);
        $query->joinWith('Campaign', $joinBehavior);

        return $this->getPartnershipsRelatedByPartnerId($query, $con);
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        $this->id = null;
        $this->username = null;
        $this->first_name = null;
        $this->last_name = null;
        $this->last_active = null;
        $this->email = null;
        $this->score = null;
        $this->token = null;
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
            if ($this->collPartnershipsRelatedByUserId) {
                foreach ($this->collPartnershipsRelatedByUserId as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collPartnershipsRelatedByPartnerId) {
                foreach ($this->collPartnershipsRelatedByPartnerId as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collPartnershipsRelatedByUserId = null;
        $this->collPartnershipsRelatedByPartnerId = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(UserTableMap::DEFAULT_STRING_FORMAT);
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
