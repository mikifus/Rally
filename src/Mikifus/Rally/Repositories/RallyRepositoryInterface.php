<?php
/**
 * Created by Fabrizio Fenoglio.
 *
 * @package Rally v1.0.0
 * Released under MIT Licence
 *
 */

namespace Mikifus\Rally\Repositories;

/**
 * Interface RallyRepositoryInterface
 * @package Mikifus\Rally\Repositories
 */
interface RallyRepositoryInterface {

    /**
     * @param array $follow_information
     * @return mixed
     */
    public function follow(array $follow_information);

    /**
     * @param $objectFollow
     * @return mixed
     */
    public function unFollow($objectFollow);

    /**
     * @param array $follower
     * @return mixed
     */
    public function isFollower(array $follower);

    /**
     * @param array $followed
     * @param $filters
     * @return mixed
     */
    public function listsFollowers(array $followed,$filters);

    /**
     * @param array $followed
     * @param $filters
     * @return mixed
     */
    public function listsFollowing(array $followed,$filters);

    /**
     * @param array $followed
     * @return mixed
     */
    public function countFollowers(array $followed);

    /**
     * Initialize empty query
     *
     * @param       $followed
     * @param array $filters
     * @return mixed
     */
    public function emptyQuery($followed,array $filters);
}
