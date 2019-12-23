<?php

namespace App\Entity;

class CandidateSearch
{
    /**
     * @var string|null
     */
    protected $candidateSearch;


    /**
     * Get the value of candidateSearch
     *
     * @return  string|null
     */
    public function getCandidateSearch()
    {
        return $this->candidateSearch;
    }

    /**
     * Set the value of candidateSearch
     *
     * @param   string|null  $candidateSearch  
     *
     * @return  self
     */
    public function setCandidateSearch($candidateSearch)
    {
        $this->candidateSearch = $candidateSearch;

        return $this;
    }
}
