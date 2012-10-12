<?php
namespace PHPStats\PDistribution;

/**
* PHP Statistics Library
*
* Copyright (C) 2011-2012 Michael Cordingley<Michael.Cordingley@gmail.com>
* 
* This library is free software; you can redistribute it and/or modify
* it under the terms of the GNU Library General Public License as published
* by the Free Software Foundation; either version 3 of the License, or 
* (at your option) any later version.
* 
* This library is distributed in the hope that it will be useful, but
* WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY
* or FITNESS FOR A PARTICULAR PURPOSE. See the GNU Library General Public
* License for more details.
* 
* You should have received a copy of the GNU Library General Public License
* along with this library; if not, write to the Free Software Foundation, 
* Inc., 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301 USA
* 
* LGPL Version 3
*
* @package PHPStats
*/

use PHPStats\Exception as PHPStatsException,
    PHPStats\PCalculator\Poisson as PoissonCalculator;

/**
* Poisson class
* 
* Represents the Poisson distribution, a distribution that represents the
* number of independent, exponentially-distributed events that occur in a
* fixed interval.  
*
* For more information, see: http://en.wikipedia.org/wiki/Poisson_distribution
*
* @author Michael Cordingley <Michael.Cordingley@gmail.com>
*/
class Poisson implements ProbabilityDistributionInterface
{
    private $lambda;
    
    /**
      *  @var PoissonCalculator 
      */
    protected $calculator;
    
    /**
     * Constructor function
     * 
     * @param float $lambda The average number of arrivals
     */
    public function __construct($lambda, PoissonCalculator $cal)
    {
	$this->lambda     = $lambda;
	$this->calculator = $cal;
    }
    
    /**
     * Returns a random float between $minimum and $minimum plus $maximum
     * 
     * @return float The random variate.
     */
    public function rvs()
    {
	return $this->calculator->getRvs($this->lambda);
    }
    
    /**
     * Returns the probability mass function
     * 
     * @param float $x The test value
     * @return float The probability
     */
    public function pmf($x)
    {
	return $this->calculator->getPmf($x, $this->lambda);
    }
    
    /**
     * Probability Distribution function
     * 
     * Alias for pmf
     * 
     * @param float $x The test value
     * @return float The probability
     */
    public function pdf($x)
    {
	return $this->calculator->pmf($x);
    }
    
    /**
     * Returns the cumulative distribution function, the probability of getting the test value or something below it
     * 
     * @param float $x The test value
     * @return float The probability
     */
    public function cdf($x)
    {
	return $this->calculator->getCdf($x, $this->lambda);
    }
    
    /**
     * Returns the survival function, the probability of getting the test value or something above it
     * 
     * @param float $x The test value
     * @return float The probability
     */
    public function sf($x)
    {
	return $this->calculator->getSf($x, $this->lambda);
    }
    
    /**
     * Returns the percent-point function, the inverse of the cdf
     * 
     * @param float $x The test value
     * @return float The value that gives a cdf of $x
     */
    public function ppf($x)
    {
	return $this->calculator->getPpf($x, $this->lambda);
    }
    
    /**
     * Returns the inverse survival function, the inverse of the sf
     * 
     * @param float $x The test value
     * @return float The value that gives an sf of $x
     */
    public function isf($x)
    {
	return $this->calculator->getIsf($x, $this->lambda);
    }
    
    /**
     * Returns the moments of the distribution
     * 
     * @param string $moments Which moments to compute. m for mean, v for variance, s for skew, k for kurtosis.  Default 'mv'
     * @return type array A dictionary containing the first four moments of the distribution
     */
    public function stats($moments = 'mv')
    {
	return $this->calculator->getStats($moments, $this->lambda);
    }
       
       
}
/* End of File */
