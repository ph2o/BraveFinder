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
     * @ORM\ManyToOne(targetEntity="App\Entity\Size")
     */
    private $firePants;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Size")
     */
    private $sweat;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Size")
     */
    private $teeshirt;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Size")
     */
    private $fireJacket;

    /**
     * @ORM\Column(type="string", length=16, nullable=true)
     */
    private $SocialNumber;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $originName;

    /**
     * @ORM\ManyToOne(targetEntity=PathWay::class)
     */
    private $PathWay;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $Iban;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $BankName;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $Education;

    /**
     * @ORM\ManyToOne(targetEntity=Title::class)
     */
    private $Title;

    /**
     * @ORM\ManyToOne(targetEntity=MaritalStatus::class)
     */
    private $MaritalStatus;

    /**
     * @ORM\ManyToOne(targetEntity=Station::class, inversedBy="candidates")
     */
    private $Station;

    /**
     * @ORM\ManyToOne(targetEntity=Size::class)
     */
    private $HeadCircumference;

    /**
     * @ORM\Column(type="boolean")
     */
    private $engaged;


    public function __construct()
    {
        $this->created_at = new \DateTimeImmutable();
        $this->updated_at = new \DateTimeImmutable();
        $this->evaluations = new ArrayCollection();
        $this->onSite = false;
        $this->engaged = false;
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
        $birthdate = $this->birthdate == null? new \DateTime(): $this->birthdate;
        return $birthdate;
    }

    public function setBirthdate(?\DateTimeInterface $birthdate): self
    {
        $this->birthdate = $birthdate;

        return $this;
    }

    public function getAge(): int {
        $referenceDateTimeObject = new \DateTime();
        $diff = $referenceDateTimeObject->diff($this->getBirthdate());
        return $diff->y;
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

    /**
     * Add an evaluation
     *
     * @param Evaluation $evaluation
     * @return self
     */
    public function addEvaluation(Evaluation $evaluation): self
    {
        if (!$this->evaluations->contains($evaluation)) {
            $this->evaluations[] = $evaluation;
            $evaluation->setCandidate($this);
        }

        return $this;
    }

    /**
     * Remove an evaluation
     *
     * @param Evaluation $evaluation
     * @return self
     */
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

    /**
     * Permet d'afficher simplement une occurance de l'objet dans les listes déroulantes
     *
     * @return string
     */
    public function __toString()
    {
        return $this->name . ' ' . $this->firstname;
    }

    public function getSocialNumber(): ?string
    {
        return $this->SocialNumber;
    }

    public function setSocialNumber(?string $SocialNumber): self
    {
        $this->SocialNumber = $SocialNumber;

        return $this;
    }

    public function getOriginName(): ?string
    {
        return $this->originName;
    }

    public function setOriginName(?string $originName): self
    {
        $this->originName = $originName;

        return $this;
    }

    public function getPathWay(): ?PathWay
    {
        return $this->PathWay;
    }

    public function setPathWay(?PathWay $PathWay): self
    {
        $this->PathWay = $PathWay;

        return $this;
    }

    public function getIban(): ?string
    {
        return $this->Iban;
    }

    public function setIban(?string $Iban): self
    {
        $this->Iban = $Iban;

        return $this;
    }

    public function getBankName(): ?string
    {
        return $this->BankName;
    }

    public function setBankName(?string $BankName): self
    {
        $this->BankName = $BankName;

        return $this;
    }

    public function getEducation(): ?string
    {
        return $this->Education;
    }

    public function setEducation(?string $Education): self
    {
        $this->Education = $Education;

        return $this;
    }

    public function getTitle(): ?Title
    {
        return $this->Title;
    }

    public function setTitle(?Title $Title): self
    {
        $this->Title = $Title;

        return $this;
    }

    public function getMaritalStatus(): ?MaritalStatus
    {
        return $this->MaritalStatus;
    }

    public function setMaritalStatus(?MaritalStatus $MaritalStatus): self
    {
        $this->MaritalStatus = $MaritalStatus;

        return $this;
    }

    public function getStation(): ?Station
    {
        return $this->Station;
    }

    public function setStation(?Station $Station): self
    {
        $this->Station = $Station;

        return $this;
    }

    public function getHeadCircumference(): ?Size
    {
        return $this->HeadCircumference;
    }

    public function setHeadCircumference(?Size $HeadCircumference): self
    {
        $this->HeadCircumference = $HeadCircumference;

        return $this;
    }

    public function getEngaged(): ?bool
    {
        return $this->engaged;
    }

    public function setEngaged(bool $engaged): self
    {
        $this->engaged = $engaged;

        return $this;
    }
}
