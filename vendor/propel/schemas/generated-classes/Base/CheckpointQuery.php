<?php

namespace Base;

use \Checkpoint as ChildCheckpoint;
use \CheckpointQuery as ChildCheckpointQuery;
use \Exception;
use \PDO;
use Map\CheckpointTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'checkpoint' table.
 *
 *
 *
 * @method     ChildCheckpointQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildCheckpointQuery orderByCampaignId($order = Criteria::ASC) Order by the campaign_id column
 * @method     ChildCheckpointQuery orderByDate($order = Criteria::ASC) Order by the date column
 * @method     ChildCheckpointQuery orderByCompleted($order = Criteria::ASC) Order by the completed column
 *
 * @method     ChildCheckpointQuery groupById() Group by the id column
 * @method     ChildCheckpointQuery groupByCampaignId() Group by the campaign_id column
 * @method     ChildCheckpointQuery groupByDate() Group by the date column
 * @method     ChildCheckpointQuery groupByCompleted() Group by the completed column
 *
 * @method     ChildCheckpointQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildCheckpointQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildCheckpointQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildCheckpointQuery leftJoinCampaign($relationAlias = null) Adds a LEFT JOIN clause to the query using the Campaign relation
 * @method     ChildCheckpointQuery rightJoinCampaign($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Campaign relation
 * @method     ChildCheckpointQuery innerJoinCampaign($relationAlias = null) Adds a INNER JOIN clause to the query using the Campaign relation
 *
 * @method     \CampaignQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildCheckpoint findOne(ConnectionInterface $con = null) Return the first ChildCheckpoint matching the query
 * @method     ChildCheckpoint findOneOrCreate(ConnectionInterface $con = null) Return the first ChildCheckpoint matching the query, or a new ChildCheckpoint object populated from the query conditions when no match is found
 *
 * @method     ChildCheckpoint findOneById(int $id) Return the first ChildCheckpoint filtered by the id column
 * @method     ChildCheckpoint findOneByCampaignId(int $campaign_id) Return the first ChildCheckpoint filtered by the campaign_id column
 * @method     ChildCheckpoint findOneByDate(string $date) Return the first ChildCheckpoint filtered by the date column
 * @method     ChildCheckpoint findOneByCompleted(boolean $completed) Return the first ChildCheckpoint filtered by the completed column *

 * @method     ChildCheckpoint requirePk($key, ConnectionInterface $con = null) Return the ChildCheckpoint by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCheckpoint requireOne(ConnectionInterface $con = null) Return the first ChildCheckpoint matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCheckpoint requireOneById(int $id) Return the first ChildCheckpoint filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCheckpoint requireOneByCampaignId(int $campaign_id) Return the first ChildCheckpoint filtered by the campaign_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCheckpoint requireOneByDate(string $date) Return the first ChildCheckpoint filtered by the date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCheckpoint requireOneByCompleted(boolean $completed) Return the first ChildCheckpoint filtered by the completed column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCheckpoint[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildCheckpoint objects based on current ModelCriteria
 * @method     ChildCheckpoint[]|ObjectCollection findById(int $id) Return ChildCheckpoint objects filtered by the id column
 * @method     ChildCheckpoint[]|ObjectCollection findByCampaignId(int $campaign_id) Return ChildCheckpoint objects filtered by the campaign_id column
 * @method     ChildCheckpoint[]|ObjectCollection findByDate(string $date) Return ChildCheckpoint objects filtered by the date column
 * @method     ChildCheckpoint[]|ObjectCollection findByCompleted(boolean $completed) Return ChildCheckpoint objects filtered by the completed column
 * @method     ChildCheckpoint[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class CheckpointQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\CheckpointQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'hophacks', $modelName = '\\Checkpoint', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildCheckpointQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildCheckpointQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildCheckpointQuery) {
            return $criteria;
        }
        $query = new ChildCheckpointQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildCheckpoint|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = CheckpointTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(CheckpointTableMap::DATABASE_NAME);
        }
        $this->basePreSelect($con);
        if ($this->formatter || $this->modelAlias || $this->with || $this->select
         || $this->selectColumns || $this->asColumns || $this->selectModifiers
         || $this->map || $this->having || $this->joins) {
            return $this->findPkComplex($key, $con);
        } else {
            return $this->findPkSimple($key, $con);
        }
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildCheckpoint A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, campaign_id, date, completed FROM checkpoint WHERE id = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildCheckpoint $obj */
            $obj = new ChildCheckpoint();
            $obj->hydrate($row);
            CheckpointTableMap::addInstanceToPool($obj, (string) $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildCheckpoint|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildCheckpointQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(CheckpointTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildCheckpointQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(CheckpointTableMap::COL_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCheckpointQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(CheckpointTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(CheckpointTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CheckpointTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the campaign_id column
     *
     * Example usage:
     * <code>
     * $query->filterByCampaignId(1234); // WHERE campaign_id = 1234
     * $query->filterByCampaignId(array(12, 34)); // WHERE campaign_id IN (12, 34)
     * $query->filterByCampaignId(array('min' => 12)); // WHERE campaign_id > 12
     * </code>
     *
     * @see       filterByCampaign()
     *
     * @param     mixed $campaignId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCheckpointQuery The current query, for fluid interface
     */
    public function filterByCampaignId($campaignId = null, $comparison = null)
    {
        if (is_array($campaignId)) {
            $useMinMax = false;
            if (isset($campaignId['min'])) {
                $this->addUsingAlias(CheckpointTableMap::COL_CAMPAIGN_ID, $campaignId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($campaignId['max'])) {
                $this->addUsingAlias(CheckpointTableMap::COL_CAMPAIGN_ID, $campaignId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CheckpointTableMap::COL_CAMPAIGN_ID, $campaignId, $comparison);
    }

    /**
     * Filter the query on the date column
     *
     * Example usage:
     * <code>
     * $query->filterByDate('2011-03-14'); // WHERE date = '2011-03-14'
     * $query->filterByDate('now'); // WHERE date = '2011-03-14'
     * $query->filterByDate(array('max' => 'yesterday')); // WHERE date > '2011-03-13'
     * </code>
     *
     * @param     mixed $date The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCheckpointQuery The current query, for fluid interface
     */
    public function filterByDate($date = null, $comparison = null)
    {
        if (is_array($date)) {
            $useMinMax = false;
            if (isset($date['min'])) {
                $this->addUsingAlias(CheckpointTableMap::COL_DATE, $date['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($date['max'])) {
                $this->addUsingAlias(CheckpointTableMap::COL_DATE, $date['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CheckpointTableMap::COL_DATE, $date, $comparison);
    }

    /**
     * Filter the query on the completed column
     *
     * Example usage:
     * <code>
     * $query->filterByCompleted(true); // WHERE completed = true
     * $query->filterByCompleted('yes'); // WHERE completed = true
     * </code>
     *
     * @param     boolean|string $completed The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCheckpointQuery The current query, for fluid interface
     */
    public function filterByCompleted($completed = null, $comparison = null)
    {
        if (is_string($completed)) {
            $completed = in_array(strtolower($completed), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(CheckpointTableMap::COL_COMPLETED, $completed, $comparison);
    }

    /**
     * Filter the query by a related \Campaign object
     *
     * @param \Campaign|ObjectCollection $campaign The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildCheckpointQuery The current query, for fluid interface
     */
    public function filterByCampaign($campaign, $comparison = null)
    {
        if ($campaign instanceof \Campaign) {
            return $this
                ->addUsingAlias(CheckpointTableMap::COL_CAMPAIGN_ID, $campaign->getId(), $comparison);
        } elseif ($campaign instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(CheckpointTableMap::COL_CAMPAIGN_ID, $campaign->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByCampaign() only accepts arguments of type \Campaign or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Campaign relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildCheckpointQuery The current query, for fluid interface
     */
    public function joinCampaign($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Campaign');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Campaign');
        }

        return $this;
    }

    /**
     * Use the Campaign relation Campaign object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \CampaignQuery A secondary query class using the current class as primary query
     */
    public function useCampaignQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinCampaign($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Campaign', '\CampaignQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildCheckpoint $checkpoint Object to remove from the list of results
     *
     * @return $this|ChildCheckpointQuery The current query, for fluid interface
     */
    public function prune($checkpoint = null)
    {
        if ($checkpoint) {
            $this->addUsingAlias(CheckpointTableMap::COL_ID, $checkpoint->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the checkpoint table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CheckpointTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            CheckpointTableMap::clearInstancePool();
            CheckpointTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CheckpointTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(CheckpointTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            CheckpointTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            CheckpointTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // CheckpointQuery
