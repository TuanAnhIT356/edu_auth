<?php
/**
 * Created by PhpStorm.
 * User: tuananh
 * Date: 18/03/2019
 * Time: 15:37
 */

namespace App\Listeners;


use Illuminate\Contracts\Hashing\Hasher;

class MD5Hasher implements Hasher
{

    /**
     * Get information about the given hashed value.
     *
     * @param  string $hashedValue
     * @return array
     */
    public function info($hashedValue)
    {

    }

    /**
     * Hash the given value.
     *
     * @param  string $value
     * @param array $options
     * @return array   $options
     */
    public function make($value, array $options = [])
    {
        return hash('md5', $value);
    }

    /**
     * Check the given plain value against a hash.
     *
     * @param  string $value
     * @param  string $hashedValue
     * @param  array $options
     * @return bool
     */
    public function check($value, $hashedValue, array $options = [])
    {
        return $this->make($value) === $hashedValue;
    }

    /**
     * Check if the given hash has been hashed using the given options.
     *
     * @param  string $hashedValue
     * @param  array $options
     * @return bool
     */
    public function needsRehash($hashedValue, array $options = array())
    {
        return false;
    }

}
