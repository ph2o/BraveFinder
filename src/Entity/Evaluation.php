<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EvaluationRepository")
 */
class Evaluation
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Candidate", inversedBy="evaluations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $candidate;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Practice", inversedBy="evaluations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $practice;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\Range(
     *      min = 0,
     *      max = 5,
     *      notInRangeMessage = "Evaluation entre {{ min }} et {{ max }}"
     * )
     */
    private $rate;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $comment;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updated_at;

    /**
     * @ORM\ManyToOne(targetEntity=Interviewer::class)
     */
    private $interviewer_1;

    /**
     * @ORM\ManyToOne(targetEntity=Interviewer::class)
     */
    private $interviewer_2;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $validate;

    public function __construct()
    {
        $this->created_at = new \DateTimeImmutable();
        $this->updated_at = new \DateTimeImmutable();
        $this->rate = 0;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCandidate(): ?candidate
    {
        return $this->candidate;
    }

    public function setCandidate(?candidate $candidate): self
    {
        $this->candidate = $candidate;

        return $this;
    }

    public function getPractice(): ?practice
    {
        return $this->practice;
    }

    public function setPractice(?practice $practice): self
    {
        $this->practice = $practice;

        return $this;
    }

    public function getRate(): ?int
    {
        return $this->rate;
    }

    public function setRate(?int $rate): self
    {
        $this->rate = $rate;

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(?string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at?? new \DateTime();

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    /**
     * Set la date de mise à jour.
     *
     * @ORM\PreUpdate
     */
    public function SetUpdateDateTime()
    {
        $this->updated_at = new \DateTime();
    }

    public function getInterviewer1(): ?Interviewer
    {
        return $this->interviewer_1;
    }

    public function setInterviewer1(?Interviewer $interviewer_1): self
    {
        $this->interviewer_1 = $interviewer_1;

        return $this;
    }

    public function getInterviewer2(): ?Interviewer
    {
        return $this->interviewer_2;
    }

    public function setInterviewer2(?Interviewer $interviewer_2): self
    {
        $this->interviewer_2 = $interviewer_2;

        return $this;
    }

    public function getValidate(): ?bool
    {
        return $this->validate;
    }

    public function setValidate(int $validate): self
    {
        $this->validate = $validate;

        return $this;
    }
}
