<?php

namespace Base;

use \Partnership as ChildPartnership;
use \PartnershipQuery as ChildPartnershipQuery;
use \Exception;
use \PDO;
use Map\PartnershipTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'partnership' table.
 *
 *
 *
 * @method     ChildPartnershipQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildPartnershipQuery orderByUserId($order = Criteria::ASC) Order by the user_id column
 * @method     ChildPartnershipQuery orderByPartnerId($order = Criteria::ASC) Order by the partner_id column
 * @method     ChildPartnershipQuery orderByCampaignId($order = Criteria::ASC) Order by the campaign_id column
 *
 * @method     ChildPartnershipQuery groupById() Group by the id column
 * @method     ChildPartnershipQuery groupByUserId() Group by the user_id column
 * @method     ChildPartnershipQuery groupByPartnerId() Group by the partner_id column
 * @method     ChildPartnershipQuery groupByCampaignId() Group by the campaign_id column
 *
 * @method     ChildPartnershipQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildPartnershipQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildPartnershipQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildPartnershipQuery leftJoinUserRelatedByUserId($relationAlias = null) Adds a LEFT JOIN clause to the query using the UserRelatedByUserId relation
 * @method     ChildPartnershipQuery rightJoinUserRelatedByUserId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the UserRelatedByUserId relation
 * @method     ChildPartnershipQuery innerJoinUserRelatedByUserId($relationAlias = null) Adds a INNER JOIN clause to the query using the UserRelatedByUserId relation
 *
 * @method     ChildPartnershipQuery leftJoinUserRelatedByPartnerId($relationAlias = null) Adds a LEFT JOIN clause to the query using the UserRelatedByPartnerId relation
 * @method     ChildPartnershipQuery rightJoinUserRelatedByPartnerId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the UserRelatedByPartnerId relation
 * @method     ChildPartnershipQuery innerJoinUserRelatedByPartnerId($relationAlias = null) Adds a INNER JOIN clause to the query using the UserRelatedByPartnerId relation
 *
 * @method     ChildPartnershipQuery leftJoinCampaign($relationAlias = null) Adds a LEFT JOIN clause to the query using the Campaign relation
 * @method     ChildPartnershipQuery rightJoinCampaign($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Campaign relation
 * @method     ChildPartnershipQuery innerJoinCampaign($relationAlias = null) Adds a INNER JOIN clause to the query using the Campaign relation
 *
 * @method     \UserQuery|\CampaignQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildPartnership findOne(ConnectionInterface $con = null) Return the first ChildPartnership matching the query
 * @method     ChildPartnership findOneOrCreate(ConnectionInterface $con = null) Return the first ChildPartnership matching the query, or a new ChildPartnership object populated from the query conditions when no match is found
 *
 * @method     ChildPartnership findOneById(int $id) Return the first ChildPartnership filtered by the id column
 * @method     ChildPartnership findOneByUserId(int $user_id) Return the first ChildPartnership filtered by the user_id column
 * @method     ChildPartnership findOneByPartnerId(int $partner_id) Return the first ChildPartnership filtered by the partner_id column
 * @method     ChildPartnership findOneByCampaignId(int $campaign_id) Return the first ChildPartnership filtered by the campaign_id column *

 * @method     ChildPartnership requirePk($key, ConnectionInterface $con = null) Return the ChildPartnership by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPartnership requireOne(ConnectionInterface $con = null) Return the first ChildPartnership matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPartnership requireOneById(int $id) Return the first ChildPartnership filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPartnership requireOneByUserId(int $user_id) Return the first ChildPartnership filtered by the user_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPartnership requireOneByPartnerId(int $partner_id) Return the first ChildPartnership filtered by the partner_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPartnership requireOneByCampaignId(int $campaign_id) Return the first ChildPartnership filtered by the campaign_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPartnership[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildPartnership objects based on current ModelCriteria
 * @method     ChildPartnership[]|ObjectCollection findById(int $id) Return ChildPartnership objects filtered by the id column
 * @method     ChildPartnership[]|ObjectCollection findByUserId(int $user_id) Return ChildPartnership objects filtered by the user_id column
 * @method     ChildPartnership[]|ObjectCollection findByPartnerId(int $partner_id) Return ChildPartnership objects filtered by the partner_id column
 * @method     ChildPartnership[]|ObjectCollection findByCampaignId(int $campaign_id) Return ChildPartnership objects filtered by the campaign_id column
 * @method     ChildPartnership[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class PartnershipQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\PartnershipQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'hophacks', $modelName = '\\Partnership', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildPartnershipQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildPartnershipQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildPartnershipQuery) {
            return $criteria;
        }
        $query = new ChildPartnershipQuery();
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
     * @return ChildPartnership|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = PartnershipTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(PartnershipTableMap::DATABASE_NAME);
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
     * @return ChildPartnership A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, user_id, partner_id, campaign_id FROM partnership WHERE id = :p0';
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
            /** @var ChildPartnership $obj */
            $obj = new ChildPartnership();
            $obj->hydrate($row);
            PartnershipTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildPartnership|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildPartnershipQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(PartnershipTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildPartnershipQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(PartnershipTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildPartnershipQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(PartnershipTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(PartnershipTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PartnershipTableMap::COL_ID, $id, $comparison);
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
     * @see       filterByUserRelatedByUserId()
     *
     * @param     mixed $userId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPartnershipQuery The current query, for fluid interface
     */
    public function filterByUserId($userId = null, $comparison = null)
    {
        if (is_array($userId)) {
            $useMinMax = false;
            if (isset($userId['min'])) {
                $this->addUsingAlias(PartnershipTableMap::COL_USER_ID, $userId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($userId['max'])) {
                $this->addUsingAlias(PartnershipTableMap::COL_USER_ID, $userId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PartnershipTableMap::COL_USER_ID, $userId, $comparison);
    }

    /**
     * Filter the query on the partner_id column
     *
     * Example usage:
     * <code>
     * $query->filterByPartnerId(1234); // WHERE partner_id = 1234
     * $query->filterByPartnerId(array(12, 34)); // WHERE partner_id IN (12, 34)
     * $query->filterByPartnerId(array('min' => 12)); // WHERE partner_id > 12
     * </code>
     *
     * @see       filterByUserRelatedByPartnerId()
     *
     * @param     mixed $partnerId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPartnershipQuery The current query, for fluid interface
     */
    public function filterByPartnerId($partnerId = null, $comparison = null)
    {
        if (is_array($partnerId)) {
            $useMinMax = false;
            if (isset($partnerId['min'])) {
                $this->addUsingAlias(PartnershipTableMap::COL_PARTNER_ID, $partnerId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($partnerId['max'])) {
                $this->addUsingAlias(PartnershipTableMap::COL_PARTNER_ID, $partnerId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PartnershipTableMap::COL_PARTNER_ID, $partnerId, $comparison);
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
     * @return $this|ChildPartnershipQuery The current query, for fluid interface
     */
    public function filterByCampaignId($campaignId = null, $comparison = null)
    {
        if (is_array($campaignId)) {
            $useMinMax = false;
            if (isset($campaignId['min'])) {
                $this->addUsingAlias(PartnershipTableMap::COL_CAMPAIGN_ID, $campaignId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($campaignId['max'])) {
                $this->addUsingAlias(PartnershipTableMap::COL_CAMPAIGN_ID, $campaignId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PartnershipTableMap::COL_CAMPAIGN_ID, $campaignId, $comparison);
    }

    /**
     * Filter the query by a related \User object
     *
     * @param \User|ObjectCollection $user The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildPartnershipQuery The current query, for fluid interface
     */
    public function filterByUserRelatedByUserId($user, $comparison = null)
    {
        if ($user instanceof \User) {
            return $this
                ->addUsingAlias(PartnershipTableMap::COL_USER_ID, $user->getId(), $comparison);
        } elseif ($user instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PartnershipTableMap::COL_USER_ID, $user->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByUserRelatedByUserId() only accepts arguments of type \User or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the UserRelatedByUserId relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPartnershipQuery The current query, for fluid interface
     */
    public function joinUserRelatedByUserId($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('UserRelatedByUserId');

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
            $this->addJoinObject($join, 'UserRelatedByUserId');
        }

        return $this;
    }

    /**
     * Use the UserRelatedByUserId relation User object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \UserQuery A secondary query class using the current class as primary query
     */
    public function useUserRelatedByUserIdQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinUserRelatedByUserId($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'UserRelatedByUserId', '\UserQuery');
    }

    /**
     * Filter the query by a related \User object
     *
     * @param \User|ObjectCollection $user The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildPartnershipQuery The current query, for fluid interface
     */
    public function filterByUserRelatedByPartnerId($user, $comparison = null)
    {
        if ($user instanceof \User) {
            return $this
                ->addUsingAlias(PartnershipTableMap::COL_PARTNER_ID, $user->getId(), $comparison);
        } elseif ($user instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PartnershipTableMap::COL_PARTNER_ID, $user->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByUserRelatedByPartnerId() only accepts arguments of type \User or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the UserRelatedByPartnerId relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPartnershipQuery The current query, for fluid interface
     */
    public function joinUserRelatedByPartnerId($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('UserRelatedByPartnerId');

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
            $this->addJoinObject($join, 'UserRelatedByPartnerId');
        }

        return $this;
    }

    /**
     * Use the UserRelatedByPartnerId relation User object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \UserQuery A secondary query class using the current class as primary query
     */
    public function useUserRelatedByPartnerIdQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinUserRelatedByPartnerId($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'UserRelatedByPartnerId', '\UserQuery');
    }

    /**
     * Filter the query by a related \Campaign object
     *
     * @param \Campaign|ObjectCollection $campaign The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildPartnershipQuery The current query, for fluid interface
     */
    public function filterByCampaign($campaign, $comparison = null)
    {
        if ($campaign instanceof \Campaign) {
            return $this
                ->addUsingAlias(PartnershipTableMap::COL_CAMPAIGN_ID, $campaign->getId(), $comparison);
        } elseif ($campaign instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PartnershipTableMap::COL_CAMPAIGN_ID, $campaign->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildPartnershipQuery The current query, for fluid interface
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
     * @param   ChildPartnership $partnership Object to remove from the list of results
     *
     * @return $this|ChildPartnershipQuery The current query, for fluid interface
     */
    public function prune($partnership = null)
    {
        if ($partnership) {
            $this->addUsingAlias(PartnershipTableMap::COL_ID, $partnership->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the partnership table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PartnershipTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            PartnershipTableMap::clearInstancePool();
            PartnershipTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(PartnershipTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(PartnershipTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            PartnershipTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            PartnershipTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // PartnershipQuery
