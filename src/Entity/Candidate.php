<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CandidateRepository")
 * @Vich\Uploadable
 */
class Candidate
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $firstname;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $birthdate;

    /**
     * @ORM\Column(type="string", length=13, nullable=true)
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=13, nullable=true)
     */
    private $mobile;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $street;

    /**
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    private $houseNumber;

    /**
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    private $zip;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $mail;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $mailPro;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updated_at;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $picture;

    /**
     * Objet contenant l'image stockée par le bundle VichUpload
     * @Vich\UploadableField(mapping="candidate_image", fileNameProperty="picture")
     */
    private $pictureFile;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Evaluation", mappedBy="candidate", orphanRemoval=true)
     */
    private $evaluations;

    /**
     * @ORM\Column(type="boolean")
     */
    private $onSite;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $rubberBoots;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $rangerBoots;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $fireGloves;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\DetailSize")
     */
    private $waitingPants;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\DetailSize")
     */
    private $firePants;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\DetailSize")
     */
    private $sweat;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\DetailSize")
     */
    private $teeshirt;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\DetailSize")
     */
    private $fireJacket;


    public function __construct()
    {
        $this->created_at = new \DateTimeImmutable();
        $this->updated_at = new \DateTimeImmutable();
        $this->evaluations = new ArrayCollection();
        $this->onSite = false;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getBirthdate(): ?\DateTimeInterface
    {
        return $this->birthdate;
    }

    public function setBirthdate(?\DateTimeInterface $birthdate): self
    {
        $this->birthdate = $birthdate;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getMobile(): ?string
    {
        return $this->mobile;
    }

    public function setMobile(?string $mobile): self
    {
        $this->mobile = $mobile;

        return $this;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function setStreet(?string $street): self
    {
        $this->street = $street;

        return $this;
    }

    public function getHouseNumber(): ?string
    {
        return $this->houseNumber;
    }

    public function setHouseNumber(?string $houseNumber): self
    {
        $this->houseNumber = $houseNumber;

        return $this;
    }

    public function getZip(): ?string
    {
        return $this->zip;
    }

    public function setZip(?string $zip): self
    {
        $this->zip = $zip;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(?string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    public function getMailPro(): ?string
    {
        return $this->mailPro;
    }

    public function setMailPro(?string $mailPro): self
    {
        $this->mailPro = $mailPro;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

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

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * Get the value of rubberBoots
     *
     * @return  mixed
     */
    public function getRubberBoots()
    {
        return $this->rubberBoots;
    }

    public function getOnSite(): ?bool
    {
        return $this->onSite;
    }

    public function setOnSite(bool $onSite): self
    {
        $this->onSite = $onSite;

        return $this;
    }

    /**
     * Set the value of rubberBoots
     *
     * @param   mixed  $rubberBoots  
     *
     * @return  self
     */
    public function setRubberBoots($rubberBoots)
    {
        $this->rubberBoots = $rubberBoots;

        return $this;
    }

    /**
     * Get the value of rangerBoots
     *
     * @return  mixed
     */
    public function getRangerBoots()
    {
        return $this->rangerBoots;
    }

    /**
     * Set the value of rangerBoots
     *
     * @param   mixed  $rangerBoots  
     *
     * @return  self
     */
    public function setRangerBoots($rangerBoots)
    {
        $this->rangerBoots = $rangerBoots;

        return $this;
    }

    /**
     * Get the value of fireGloves
     *
     * @return  mixed
     */
    public function getFireGloves()
    {
        return $this->fireGloves;
    }

    /**
     * Set the value of fireGloves
     *
     * @param   mixed  $fireGloves  
     *
     * @return  self
     */
    public function setFireGloves($fireGloves)
    {
        $this->fireGloves = $fireGloves;

        return $this;
    }

    /**
     * Get the value of waitingPants
     *
     * @return  mixed
     */
    public function getWaitingPants()
    {
        return $this->waitingPants;
    }

    /**
     * Set the value of waitingPants
     *
     * @param   mixed  $waitingPants  
     *
     * @return  self
     */
    public function setWaitingPants($waitingPants)
    {
        $this->waitingPants = $waitingPants;

        return $this;
    }

    /**
     * Get the value of firePants
     *
     * @return  mixed
     */
    public function getFirePants()
    {
        return $this->firePants;
    }

    /**
     * Set the value of firePants
     *
     * @param   mixed  $firePants  
     *
     * @return  self
     */
    public function setFirePants($firePants)
    {
        $this->firePants = $firePants;

        return $this;
    }

    /**
     * Get the value of sweat
     *
     * @return  mixed
     */
    public function getSweat()
    {
        return $this->sweat;
    }

    /**
     * Set the value of sweat
     *
     * @param   mixed  $sweat  
     *
     * @return  self
     */
    public function setSweat($sweat)
    {
        $this->sweat = $sweat;

        return $this;
    }

    /**
     * Get the value of teeshirt
     *
     * @return  mixed
     */
    public function getTeeshirt()
    {
        return $this->teeshirt;
    }

    /**
     * Set the value of teeshirt
     *
     * @param   mixed  $teeshirt  
     *
     * @return  self
     */
    public function setTeeshirt($teeshirt)
    {
        $this->teeshirt = $teeshirt;

        return $this;
    }

    /**
     * Get the value of fireJacket
     *
     * @return  mixed
     */
    public function getFireJacket()
    {
        return $this->fireJacket;
    }

    /**
     * Set the value of fireJacket
     *
     * @param   mixed  $fireJacket  
     *
     * @return  self
     */
    public function setFireJacket($fireJacket)
    {
        $this->fireJacket = $fireJacket;

        return $this;
    }

    /**
     * Get objet contenant l'image stockée par le bundle VichUpload
     *
     * @return  mixed
     */
    public function getPictureFile(): ?File
    {
        return $this->pictureFile;
    }

    /**
     * Set objet contenant l'image stockée par le bundle VichUpload
     *
     * @return  self
     */
    public function setPictureFile(?File $pictureFile = null)
    {
        $this->pictureFile = $pictureFile;

        if (null !== $pictureFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
            return $this;
        }
    }

    /**
     * Set la date de mise à jour.
     * @ORM\PreUpdate
     */
    public function SetUpdateDateTime()
    {
        $this->updated_at = new \DateTime();
    }

    /**
     * @return Collection|Evaluation[]
     */
    public function getEvaluations(): Collection
    {
        return $this->evaluations;
    }

    public function addEvaluation(Evaluation $evaluation): self
    {
        if (!$this->evaluations->contains($evaluation)) {
            $this->evaluations[] = $evaluation;
            $evaluation->setCandidate($this);
        }

        return $this;
    }

    public function removeEvaluation(Evaluation $evaluation): self
    {
        if ($this->evaluations->contains($evaluation)) {
            $this->evaluations->removeElement($evaluation);
            // set the owning side to null (unless already changed)
            if ($evaluation->getCandidate() === $this) {
                $evaluation->setCandidate(null);
            }
        }
        return $this;
    }

    public function __toString()
    {
        return $this->name . ' ' . $this->firstname;
    }
}
