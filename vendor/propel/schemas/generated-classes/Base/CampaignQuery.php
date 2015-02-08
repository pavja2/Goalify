<?php

namespace Base;

use \Campaign as ChildCampaign;
use \CampaignQuery as ChildCampaignQuery;
use \Exception;
use \PDO;
use Map\CampaignTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'campaign' table.
 *
 *
 *
 * @method     ChildCampaignQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildCampaignQuery orderByUserId($order = Criteria::ASC) Order by the user_id column
 * @method     ChildCampaignQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildCampaignQuery orderByBeginDate($order = Criteria::ASC) Order by the begin_date column
 * @method     ChildCampaignQuery orderByEndDate($order = Criteria::ASC) Order by the end_date column
 * @method     ChildCampaignQuery orderByCampaignStatusId($order = Criteria::ASC) Order by the campaign_status_id column
 * @method     ChildCampaignQuery orderByBalanceId($order = Criteria::ASC) Order by the balance_id column
 * @method     ChildCampaignQuery orderByActivityId($order = Criteria::ASC) Order by the activity_id column
 *
 * @method     ChildCampaignQuery groupById() Group by the id column
 * @method     ChildCampaignQuery groupByUserId() Group by the user_id column
 * @method     ChildCampaignQuery groupByName() Group by the name column
 * @method     ChildCampaignQuery groupByBeginDate() Group by the begin_date column
 * @method     ChildCampaignQuery groupByEndDate() Group by the end_date column
 * @method     ChildCampaignQuery groupByCampaignStatusId() Group by the campaign_status_id column
 * @method     ChildCampaignQuery groupByBalanceId() Group by the balance_id column
 * @method     ChildCampaignQuery groupByActivityId() Group by the activity_id column
 *
 * @method     ChildCampaignQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildCampaignQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildCampaignQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildCampaignQuery leftJoinCampaignStatus($relationAlias = null) Adds a LEFT JOIN clause to the query using the CampaignStatus relation
 * @method     ChildCampaignQuery rightJoinCampaignStatus($relationAlias = null) Adds a RIGHT JOIN clause to the query using the CampaignStatus relation
 * @method     ChildCampaignQuery innerJoinCampaignStatus($relationAlias = null) Adds a INNER JOIN clause to the query using the CampaignStatus relation
 *
 * @method     ChildCampaignQuery leftJoinBalanceRelatedByBalanceId($relationAlias = null) Adds a LEFT JOIN clause to the query using the BalanceRelatedByBalanceId relation
 * @method     ChildCampaignQuery rightJoinBalanceRelatedByBalanceId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BalanceRelatedByBalanceId relation
 * @method     ChildCampaignQuery innerJoinBalanceRelatedByBalanceId($relationAlias = null) Adds a INNER JOIN clause to the query using the BalanceRelatedByBalanceId relation
 *
 * @method     ChildCampaignQuery leftJoinActivity($relationAlias = null) Adds a LEFT JOIN clause to the query using the Activity relation
 * @method     ChildCampaignQuery rightJoinActivity($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Activity relation
 * @method     ChildCampaignQuery innerJoinActivity($relationAlias = null) Adds a INNER JOIN clause to the query using the Activity relation
 *
 * @method     ChildCampaignQuery leftJoinPartnership($relationAlias = null) Adds a LEFT JOIN clause to the query using the Partnership relation
 * @method     ChildCampaignQuery rightJoinPartnership($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Partnership relation
 * @method     ChildCampaignQuery innerJoinPartnership($relationAlias = null) Adds a INNER JOIN clause to the query using the Partnership relation
 *
 * @method     ChildCampaignQuery leftJoinBalanceRelatedByCampaignId($relationAlias = null) Adds a LEFT JOIN clause to the query using the BalanceRelatedByCampaignId relation
 * @method     ChildCampaignQuery rightJoinBalanceRelatedByCampaignId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BalanceRelatedByCampaignId relation
 * @method     ChildCampaignQuery innerJoinBalanceRelatedByCampaignId($relationAlias = null) Adds a INNER JOIN clause to the query using the BalanceRelatedByCampaignId relation
 *
 * @method     ChildCampaignQuery leftJoinCheckpoint($relationAlias = null) Adds a LEFT JOIN clause to the query using the Checkpoint relation
 * @method     ChildCampaignQuery rightJoinCheckpoint($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Checkpoint relation
 * @method     ChildCampaignQuery innerJoinCheckpoint($relationAlias = null) Adds a INNER JOIN clause to the query using the Checkpoint relation
 *
 * @method     \CampaignStatusQuery|\BalanceQuery|\ActivityQuery|\PartnershipQuery|\CheckpointQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildCampaign findOne(ConnectionInterface $con = null) Return the first ChildCampaign matching the query
 * @method     ChildCampaign findOneOrCreate(ConnectionInterface $con = null) Return the first ChildCampaign matching the query, or a new ChildCampaign object populated from the query conditions when no match is found
 *
 * @method     ChildCampaign findOneById(int $id) Return the first ChildCampaign filtered by the id column
 * @method     ChildCampaign findOneByUserId(int $user_id) Return the first ChildCampaign filtered by the user_id column
 * @method     ChildCampaign findOneByName(string $name) Return the first ChildCampaign filtered by the name column
 * @method     ChildCampaign findOneByBeginDate(string $begin_date) Return the first ChildCampaign filtered by the begin_date column
 * @method     ChildCampaign findOneByEndDate(string $end_date) Return the first ChildCampaign filtered by the end_date column
 * @method     ChildCampaign findOneByCampaignStatusId(int $campaign_status_id) Return the first ChildCampaign filtered by the campaign_status_id column
 * @method     ChildCampaign findOneByBalanceId(int $balance_id) Return the first ChildCampaign filtered by the balance_id column
 * @method     ChildCampaign findOneByActivityId(int $activity_id) Return the first ChildCampaign filtered by the activity_id column *

 * @method     ChildCampaign requirePk($key, ConnectionInterface $con = null) Return the ChildCampaign by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCampaign requireOne(ConnectionInterface $con = null) Return the first ChildCampaign matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCampaign requireOneById(int $id) Return the first ChildCampaign filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCampaign requireOneByUserId(int $user_id) Return the first ChildCampaign filtered by the user_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCampaign requireOneByName(string $name) Return the first ChildCampaign filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCampaign requireOneByBeginDate(string $begin_date) Return the first ChildCampaign filtered by the begin_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCampaign requireOneByEndDate(string $end_date) Return the first ChildCampaign filtered by the end_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCampaign requireOneByCampaignStatusId(int $campaign_status_id) Return the first ChildCampaign filtered by the campaign_status_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCampaign requireOneByBalanceId(int $balance_id) Return the first ChildCampaign filtered by the balance_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCampaign requireOneByActivityId(int $activity_id) Return the first ChildCampaign filtered by the activity_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCampaign[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildCampaign objects based on current ModelCriteria
 * @method     ChildCampaign[]|ObjectCollection findById(int $id) Return ChildCampaign objects filtered by the id column
 * @method     ChildCampaign[]|ObjectCollection findByUserId(int $user_id) Return ChildCampaign objects filtered by the user_id column
 * @method     ChildCampaign[]|ObjectCollection findByName(string $name) Return ChildCampaign objects filtered by the name column
 * @method     ChildCampaign[]|ObjectCollection findByBeginDate(string $begin_date) Return ChildCampaign objects filtered by the begin_date column
 * @method     ChildCampaign[]|ObjectCollection findByEndDate(string $end_date) Return ChildCampaign objects filtered by the end_date column
 * @method     ChildCampaign[]|ObjectCollection findByCampaignStatusId(int $campaign_status_id) Return ChildCampaign objects filtered by the campaign_status_id column
 * @method     ChildCampaign[]|ObjectCollection findByBalanceId(int $balance_id) Return ChildCampaign objects filtered by the balance_id column
 * @method     ChildCampaign[]|ObjectCollection findByActivityId(int $activity_id) Return ChildCampaign objects filtered by the activity_id column
 * @method     ChildCampaign[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class CampaignQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\CampaignQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'hophacks', $modelName = '\\Campaign', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildCampaignQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildCampaignQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildCampaignQuery) {
            return $criteria;
        }
        $query = new ChildCampaignQuery();
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
     * @return ChildCampaign|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = CampaignTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(CampaignTableMap::DATABASE_NAME);
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
     * @return ChildCampaign A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, user_id, name, begin_date, end_date, campaign_status_id, balance_id, activity_id FROM campaign WHERE id = :p0';
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
            /** @var ChildCampaign $obj */
            $obj = new ChildCampaign();
            $obj->hydrate($row);
            CampaignTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildCampaign|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildCampaignQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(CampaignTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildCampaignQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(CampaignTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildCampaignQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(CampaignTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(CampaignTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CampaignTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the user_id column
     *
     * Example usage:
     * <code>
     * $query->filterByUserId(1234); // WHERE user_id = 1234
     * $query->filterByUserId(array(12, 34)); // WHERE user_id IN (12, 34)
     * $query->filterByUserId(array('min' => 12)); // WHERE user_id > 12
     * </code>
     *
     * @param     mixed $userId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCampaignQuery The current query, for fluid interface
     */
    public function filterByUserId($userId = null, $comparison = null)
    {
        if (is_array($userId)) {
            $useMinMax = false;
            if (isset($userId['min'])) {
                $this->addUsingAlias(CampaignTableMap::COL_USER_ID, $userId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($userId['max'])) {
                $this->addUsingAlias(CampaignTableMap::COL_USER_ID, $userId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CampaignTableMap::COL_USER_ID, $userId, $comparison);
    }

    /**
     * Filter the query on the name column
     *
     * Example usage:
     * <code>
     * $query->filterByName('fooValue');   // WHERE name = 'fooValue'
     * $query->filterByName('%fooValue%'); // WHERE name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $name The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCampaignQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $name)) {
                $name = str_replace('*', '%', $name);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CampaignTableMap::COL_NAME, $name, $comparison);
    }

    /**
     * Filter the query on the begin_date column
     *
     * Example usage:
     * <code>
     * $query->filterByBeginDate('2011-03-14'); // WHERE begin_date = '2011-03-14'
     * $query->filterByBeginDate('now'); // WHERE begin_date = '2011-03-14'
     * $query->filterByBeginDate(array('max' => 'yesterday')); // WHERE begin_date > '2011-03-13'
     * </code>
     *
     * @param     mixed $beginDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCampaignQuery The current query, for fluid interface
     */
    public function filterByBeginDate($beginDate = null, $comparison = null)
    {
        if (is_array($beginDate)) {
            $useMinMax = false;
            if (isset($beginDate['min'])) {
                $this->addUsingAlias(CampaignTableMap::COL_BEGIN_DATE, $beginDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($beginDate['max'])) {
                $this->addUsingAlias(CampaignTableMap::COL_BEGIN_DATE, $beginDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CampaignTableMap::COL_BEGIN_DATE, $beginDate, $comparison);
    }

    /**
     * Filter the query on the end_date column
     *
     * Example usage:
     * <code>
     * $query->filterByEndDate('2011-03-14'); // WHERE end_date = '2011-03-14'
     * $query->filterByEndDate('now'); // WHERE end_date = '2011-03-14'
     * $query->filterByEndDate(array('max' => 'yesterday')); // WHERE end_date > '2011-03-13'
     * </code>
     *
     * @param     mixed $endDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCampaignQuery The current query, for fluid interface
     */
    public function filterByEndDate($endDate = null, $comparison = null)
    {
        if (is_array($endDate)) {
            $useMinMax = false;
            if (isset($endDate['min'])) {
                $this->addUsingAlias(CampaignTableMap::COL_END_DATE, $endDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($endDate['max'])) {
                $this->addUsingAlias(CampaignTableMap::COL_END_DATE, $endDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CampaignTableMap::COL_END_DATE, $endDate, $comparison);
    }

    /**
     * Filter the query on the campaign_status_id column
     *
     * Example usage:
     * <code>
     * $query->filterByCampaignStatusId(1234); // WHERE campaign_status_id = 1234
     * $query->filterByCampaignStatusId(array(12, 34)); // WHERE campaign_status_id IN (12, 34)
     * $query->filterByCampaignStatusId(array('min' => 12)); // WHERE campaign_status_id > 12
     * </code>
     *
     * @see       filterByCampaignStatus()
     *
     * @param     mixed $campaignStatusId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCampaignQuery The current query, for fluid interface
     */
    public function filterByCampaignStatusId($campaignStatusId = null, $comparison = null)
    {
        if (is_array($campaignStatusId)) {
            $useMinMax = false;
            if (isset($campaignStatusId['min'])) {
                $this->addUsingAlias(CampaignTableMap::COL_CAMPAIGN_STATUS_ID, $campaignStatusId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($campaignStatusId['max'])) {
                $this->addUsingAlias(CampaignTableMap::COL_CAMPAIGN_STATUS_ID, $campaignStatusId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CampaignTableMap::COL_CAMPAIGN_STATUS_ID, $campaignStatusId, $comparison);
    }

    /**
     * Filter the query on the balance_id column
     *
     * Example usage:
     * <code>
     * $query->filterByBalanceId(1234); // WHERE balance_id = 1234
     * $query->filterByBalanceId(array(12, 34)); // WHERE balance_id IN (12, 34)
     * $query->filterByBalanceId(array('min' => 12)); // WHERE balance_id > 12
     * </code>
     *
     * @see       filterByBalanceRelatedByBalanceId()
     *
     * @param     mixed $balanceId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCampaignQuery The current query, for fluid interface
     */
    public function filterByBalanceId($balanceId = null, $comparison = null)
    {
        if (is_array($balanceId)) {
            $useMinMax = false;
            if (isset($balanceId['min'])) {
                $this->addUsingAlias(CampaignTableMap::COL_BALANCE_ID, $balanceId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($balanceId['max'])) {
                $this->addUsingAlias(CampaignTableMap::COL_BALANCE_ID, $balanceId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CampaignTableMap::COL_BALANCE_ID, $balanceId, $comparison);
    }

    /**
     * Filter the query on the activity_id column
     *
     * Example usage:
     * <code>
     * $query->filterByActivityId(1234); // WHERE activity_id = 1234
     * $query->filterByActivityId(array(12, 34)); // WHERE activity_id IN (12, 34)
     * $query->filterByActivityId(array('min' => 12)); // WHERE activity_id > 12
     * </code>
     *
     * @see       filterByActivity()
     *
     * @param     mixed $activityId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCampaignQuery The current query, for fluid interface
     */
    public function filterByActivityId($activityId = null, $comparison = null)
    {
        if (is_array($activityId)) {
            $useMinMax = false;
            if (isset($activityId['min'])) {
                $this->addUsingAlias(CampaignTableMap::COL_ACTIVITY_ID, $activityId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($activityId['max'])) {
                $this->addUsingAlias(CampaignTableMap::COL_ACTIVITY_ID, $activityId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CampaignTableMap::COL_ACTIVITY_ID, $activityId, $comparison);
    }

    /**
     * Filter the query by a related \CampaignStatus object
     *
     * @param \CampaignStatus|ObjectCollection $campaignStatus The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildCampaignQuery The current query, for fluid interface
     */
    public function filterByCampaignStatus($campaignStatus, $comparison = null)
    {
        if ($campaignStatus instanceof \CampaignStatus) {
            return $this
                ->addUsingAlias(CampaignTableMap::COL_CAMPAIGN_STATUS_ID, $campaignStatus->getId(), $comparison);
        } elseif ($campaignStatus instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(CampaignTableMap::COL_CAMPAIGN_STATUS_ID, $campaignStatus->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByCampaignStatus() only accepts arguments of type \CampaignStatus or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the CampaignStatus relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildCampaignQuery The current query, for fluid interface
     */
    public function joinCampaignStatus($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('CampaignStatus');

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
            $this->addJoinObject($join, 'CampaignStatus');
        }

        return $this;
    }

    /**
     * Use the CampaignStatus relation CampaignStatus object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \CampaignStatusQuery A secondary query class using the current class as primary query
     */
    public function useCampaignStatusQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinCampaignStatus($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'CampaignStatus', '\CampaignStatusQuery');
    }

    /**
     * Filter the query by a related \Balance object
     *
     * @param \Balance|ObjectCollection $balance The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildCampaignQuery The current query, for fluid interface
     */
    public function filterByBalanceRelatedByBalanceId($balance, $comparison = null)
    {
        if ($balance instanceof \Balance) {
            return $this
                ->addUsingAlias(CampaignTableMap::COL_BALANCE_ID, $balance->getId(), $comparison);
        } elseif ($balance instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(CampaignTableMap::COL_BALANCE_ID, $balance->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByBalanceRelatedByBalanceId() only accepts arguments of type \Balance or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the BalanceRelatedByBalanceId relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildCampaignQuery The current query, for fluid interface
     */
    public function joinBalanceRelatedByBalanceId($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('BalanceRelatedByBalanceId');

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
            $this->addJoinObject($join, 'BalanceRelatedByBalanceId');
        }

        return $this;
    }

    /**
     * Use the BalanceRelatedByBalanceId relation Balance object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \BalanceQuery A secondary query class using the current class as primary query
     */
    public function useBalanceRelatedByBalanceIdQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinBalanceRelatedByBalanceId($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'BalanceRelatedByBalanceId', '\BalanceQuery');
    }

    /**
     * Filter the query by a related \Activity object
     *
     * @param \Activity|ObjectCollection $activity The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildCampaignQuery The current query, for fluid interface
     */
    public function filterByActivity($activity, $comparison = null)
    {
        if ($activity instanceof \Activity) {
            return $this
                ->addUsingAlias(CampaignTableMap::COL_ACTIVITY_ID, $activity->getId(), $comparison);
        } elseif ($activity instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(CampaignTableMap::COL_ACTIVITY_ID, $activity->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByActivity() only accepts arguments of type \Activity or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Activity relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildCampaignQuery The current query, for fluid interface
     */
    public function joinActivity($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Activity');

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
            $this->addJoinObject($join, 'Activity');
        }

        return $this;
    }

    /**
     * Use the Activity relation Activity object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \ActivityQuery A secondary query class using the current class as primary query
     */
    public function useActivityQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinActivity($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Activity', '\ActivityQuery');
    }

    /**
     * Filter the query by a related \Partnership object
     *
     * @param \Partnership|ObjectCollection $partnership the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCampaignQuery The current query, for fluid interface
     */
    public function filterByPartnership($partnership, $comparison = null)
    {
        if ($partnership instanceof \Partnership) {
            return $this
                ->addUsingAlias(CampaignTableMap::COL_ID, $partnership->getCampaignId(), $comparison);
        } elseif ($partnership instanceof ObjectCollection) {
            return $this
                ->usePartnershipQuery()
                ->filterByPrimaryKeys($partnership->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByPartnership() only accepts arguments of type \Partnership or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Partnership relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildCampaignQuery The current query, for fluid interface
     */
    public function joinPartnership($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Partnership');

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
            $this->addJoinObject($join, 'Partnership');
        }

        return $this;
    }

    /**
     * Use the Partnership relation Partnership object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \PartnershipQuery A secondary query class using the current class as primary query
     */
    public function usePartnershipQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinPartnership($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Partnership', '\PartnershipQuery');
    }

    /**
     * Filter the query by a related \Balance object
     *
     * @param \Balance|ObjectCollection $balance the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCampaignQuery The current query, for fluid interface
     */
    public function filterByBalanceRelatedByCampaignId($balance, $comparison = null)
    {
        if ($balance instanceof \Balance) {
            return $this
                ->addUsingAlias(CampaignTableMap::COL_ID, $balance->getCampaignId(), $comparison);
        } elseif ($balance instanceof ObjectCollection) {
            return $this
                ->useBalanceRelatedByCampaignIdQuery()
                ->filterByPrimaryKeys($balance->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByBalanceRelatedByCampaignId() only accepts arguments of type \Balance or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the BalanceRelatedByCampaignId relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildCampaignQuery The current query, for fluid interface
     */
    public function joinBalanceRelatedByCampaignId($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('BalanceRelatedByCampaignId');

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
            $this->addJoinObject($join, 'BalanceRelatedByCampaignId');
        }

        return $this;
    }

    /**
     * Use the BalanceRelatedByCampaignId relation Balance object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \BalanceQuery A secondary query class using the current class as primary query
     */
    public function useBalanceRelatedByCampaignIdQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinBalanceRelatedByCampaignId($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'BalanceRelatedByCampaignId', '\BalanceQuery');
    }

    /**
     * Filter the query by a related \Checkpoint object
     *
     * @param \Checkpoint|ObjectCollection $checkpoint the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCampaignQuery The current query, for fluid interface
     */
    public function filterByCheckpoint($checkpoint, $comparison = null)
    {
        if ($checkpoint instanceof \Checkpoint) {
            return $this
                ->addUsingAlias(CampaignTableMap::COL_ID, $checkpoint->getCampaignId(), $comparison);
        } elseif ($checkpoint instanceof ObjectCollection) {
            return $this
                ->useCheckpointQuery()
                ->filterByPrimaryKeys($checkpoint->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByCheckpoint() only accepts arguments of type \Checkpoint or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Checkpoint relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildCampaignQuery The current query, for fluid interface
     */
    public function joinCheckpoint($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Checkpoint');

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
            $this->addJoinObject($join, 'Checkpoint');
        }

        return $this;
    }

    /**
     * Use the Checkpoint relation Checkpoint object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \CheckpointQuery A secondary query class using the current class as primary query
     */
    public function useCheckpointQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinCheckpoint($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Checkpoint', '\CheckpointQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildCampaign $campaign Object to remove from the list of results
     *
     * @return $this|ChildCampaignQuery The current query, for fluid interface
     */
    public function prune($campaign = null)
    {
        if ($campaign) {
            $this->addUsingAlias(CampaignTableMap::COL_ID, $campaign->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the campaign table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CampaignTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            CampaignTableMap::clearInstancePool();
            CampaignTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(CampaignTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(CampaignTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            CampaignTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            CampaignTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // CampaignQuery
