<?php

namespace Base;

use \Balance as ChildBalance;
use \BalanceQuery as ChildBalanceQuery;
use \Exception;
use \PDO;
use Map\BalanceTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'balance' table.
 *
 *
 *
 * @method     ChildBalanceQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildBalanceQuery orderByAmount($order = Criteria::ASC) Order by the amount column
 * @method     ChildBalanceQuery orderByPaymentInfo($order = Criteria::ASC) Order by the payment_info column
 *
 * @method     ChildBalanceQuery groupById() Group by the id column
 * @method     ChildBalanceQuery groupByAmount() Group by the amount column
 * @method     ChildBalanceQuery groupByPaymentInfo() Group by the payment_info column
 *
 * @method     ChildBalanceQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildBalanceQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildBalanceQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildBalanceQuery leftJoinCampaign($relationAlias = null) Adds a LEFT JOIN clause to the query using the Campaign relation
 * @method     ChildBalanceQuery rightJoinCampaign($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Campaign relation
 * @method     ChildBalanceQuery innerJoinCampaign($relationAlias = null) Adds a INNER JOIN clause to the query using the Campaign relation
 *
 * @method     \CampaignQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildBalance findOne(ConnectionInterface $con = null) Return the first ChildBalance matching the query
 * @method     ChildBalance findOneOrCreate(ConnectionInterface $con = null) Return the first ChildBalance matching the query, or a new ChildBalance object populated from the query conditions when no match is found
 *
 * @method     ChildBalance findOneById(int $id) Return the first ChildBalance filtered by the id column
 * @method     ChildBalance findOneByAmount(double $amount) Return the first ChildBalance filtered by the amount column
 * @method     ChildBalance findOneByPaymentInfo(string $payment_info) Return the first ChildBalance filtered by the payment_info column *

 * @method     ChildBalance requirePk($key, ConnectionInterface $con = null) Return the ChildBalance by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBalance requireOne(ConnectionInterface $con = null) Return the first ChildBalance matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildBalance requireOneById(int $id) Return the first ChildBalance filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBalance requireOneByAmount(double $amount) Return the first ChildBalance filtered by the amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBalance requireOneByPaymentInfo(string $payment_info) Return the first ChildBalance filtered by the payment_info column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildBalance[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildBalance objects based on current ModelCriteria
 * @method     ChildBalance[]|ObjectCollection findById(int $id) Return ChildBalance objects filtered by the id column
 * @method     ChildBalance[]|ObjectCollection findByAmount(double $amount) Return ChildBalance objects filtered by the amount column
 * @method     ChildBalance[]|ObjectCollection findByPaymentInfo(string $payment_info) Return ChildBalance objects filtered by the payment_info column
 * @method     ChildBalance[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class BalanceQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\BalanceQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'hophacks', $modelName = '\\Balance', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildBalanceQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildBalanceQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildBalanceQuery) {
            return $criteria;
        }
        $query = new ChildBalanceQuery();
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
     * @return ChildBalance|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = BalanceTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(BalanceTableMap::DATABASE_NAME);
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
     * @return ChildBalance A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, amount, payment_info FROM balance WHERE id = :p0';
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
            /** @var ChildBalance $obj */
            $obj = new ChildBalance();
            $obj->hydrate($row);
            BalanceTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildBalance|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildBalanceQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(BalanceTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildBalanceQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(BalanceTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildBalanceQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(BalanceTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(BalanceTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BalanceTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the amount column
     *
     * Example usage:
     * <code>
     * $query->filterByAmount(1234); // WHERE amount = 1234
     * $query->filterByAmount(array(12, 34)); // WHERE amount IN (12, 34)
     * $query->filterByAmount(array('min' => 12)); // WHERE amount > 12
     * </code>
     *
     * @param     mixed $amount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBalanceQuery The current query, for fluid interface
     */
    public function filterByAmount($amount = null, $comparison = null)
    {
        if (is_array($amount)) {
            $useMinMax = false;
            if (isset($amount['min'])) {
                $this->addUsingAlias(BalanceTableMap::COL_AMOUNT, $amount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($amount['max'])) {
                $this->addUsingAlias(BalanceTableMap::COL_AMOUNT, $amount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BalanceTableMap::COL_AMOUNT, $amount, $comparison);
    }

    /**
     * Filter the query on the payment_info column
     *
     * Example usage:
     * <code>
     * $query->filterByPaymentInfo('fooValue');   // WHERE payment_info = 'fooValue'
     * $query->filterByPaymentInfo('%fooValue%'); // WHERE payment_info LIKE '%fooValue%'
     * </code>
     *
     * @param     string $paymentInfo The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBalanceQuery The current query, for fluid interface
     */
    public function filterByPaymentInfo($paymentInfo = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($paymentInfo)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $paymentInfo)) {
                $paymentInfo = str_replace('*', '%', $paymentInfo);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(BalanceTableMap::COL_PAYMENT_INFO, $paymentInfo, $comparison);
    }

    /**
     * Filter the query by a related \Campaign object
     *
     * @param \Campaign|ObjectCollection $campaign the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildBalanceQuery The current query, for fluid interface
     */
    public function filterByCampaign($campaign, $comparison = null)
    {
        if ($campaign instanceof \Campaign) {
            return $this
                ->addUsingAlias(BalanceTableMap::COL_ID, $campaign->getBalanceId(), $comparison);
        } elseif ($campaign instanceof ObjectCollection) {
            return $this
                ->useCampaignQuery()
                ->filterByPrimaryKeys($campaign->getPrimaryKeys())
                ->endUse();
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
     * @return $this|ChildBalanceQuery The current query, for fluid interface
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
     * @param   ChildBalance $balance Object to remove from the list of results
     *
     * @return $this|ChildBalanceQuery The current query, for fluid interface
     */
    public function prune($balance = null)
    {
        if ($balance) {
            $this->addUsingAlias(BalanceTableMap::COL_ID, $balance->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the balance table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(BalanceTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            BalanceTableMap::clearInstancePool();
            BalanceTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(BalanceTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(BalanceTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            BalanceTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            BalanceTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // BalanceQuery
