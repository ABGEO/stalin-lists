<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PersonRepository")
 */
class Person
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $surname;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $patronymic;

    /**
     * @ORM\Column(type="array")
     */
    private $photos = [];

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $birthDate;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $placeOfBirth;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $dwellingPlace;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Education")
     */
    private $education;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\EducationAdditional")
     */
    private $educationAdditional;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $partying;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $workingPosition;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $conviction;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateOfArrest;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $investigator;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $sessionDate;

    /**
     * @ORM\Column(type="string", length=512, nullable=true)
     */
    private $blame;

    /**
     * @ORM\Column(type="string", length=512, nullable=true)
     */
    private $verdict;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $verdictDate;

    /**
     * @ORM\Column(type="string", length=512, nullable=true)
     */
    private $rehabilitation;

    /**
     * @ORM\Column(type="string", length=512, nullable=true)
     */
    private $notes;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $rankInPast;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\DataList")
     * @ORM\JoinColumn(nullable=false)
     */
    private $list;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\SocialStatus")
     */
    private $socialStatus;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Nationality")
     * @ORM\JoinColumn(nullable=false)
     */
    private $nationality;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\MaritalStatus")
     */
    private $maritalStatus;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ConvictOrganization")
     */
    private $convict;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CourtRepresentative")
     */
    private $presenter;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\CourtRepresentative")
     */
    private $sessionParticipants;

    /**
     * @ORM\ManyToMany(targetEntity="Clause")
     */
    private $clauses;

    public function __construct()
    {
        $this->sessionParticipants = new ArrayCollection();
        $this->clauses = new ArrayCollection();
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

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): self
    {
        $this->surname = $surname;

        return $this;
    }

    public function getPatronymic(): ?string
    {
        return $this->patronymic;
    }

    public function setPatronymic(?string $patronymic): self
    {
        $this->patronymic = $patronymic;

        return $this;
    }

    public function getPhotos(): ?array
    {
        return $this->photos;
    }

    public function setPhotos(array $photos): self
    {
        $this->photos = $photos;

        return $this;
    }

    public function getBirthDate(): ?string
    {
        return $this->birthDate;
    }

    public function setBirthDate(?string $birthDate): self
    {
        $this->birthDate = $birthDate;

        return $this;
    }

    public function getPlaceOfBirth(): ?string
    {
        return $this->placeOfBirth;
    }

    public function setPlaceOfBirth(?string $placeOfBirth): self
    {
        $this->placeOfBirth = $placeOfBirth;

        return $this;
    }

    public function getDwellingPlace(): ?string
    {
        return $this->dwellingPlace;
    }

    public function setDwellingPlace(?string $dwellingPlace): self
    {
        $this->dwellingPlace = $dwellingPlace;

        return $this;
    }

    public function getEducation(): ?Education
    {
        return $this->education;
    }

    public function setEducation(?Education $education): self
    {
        $this->education = $education;

        return $this;
    }

    public function getEducationAdditional(): ?EducationAdditional
    {
        return $this->educationAdditional;
    }

    public function setEducationAdditional(?EducationAdditional $educationAdditional): self
    {
        $this->educationAdditional = $educationAdditional;

        return $this;
    }

    public function getPartying(): ?string
    {
        return $this->partying;
    }

    public function setPartying(?string $partying): self
    {
        $this->partying = $partying;

        return $this;
    }

    public function getWorkingPosition(): ?string
    {
        return $this->workingPosition;
    }

    public function setWorkingPosition(?string $workingPosition): self
    {
        $this->workingPosition = $workingPosition;

        return $this;
    }

    public function getConviction(): ?string
    {
        return $this->conviction;
    }

    public function setConviction(?string $conviction): self
    {
        $this->conviction = $conviction;

        return $this;
    }

    public function getDateOfArrest(): ?\DateTimeInterface
    {
        return $this->dateOfArrest;
    }

    public function setDateOfArrest(?\DateTimeInterface $dateOfArrest): self
    {
        $this->dateOfArrest = $dateOfArrest;

        return $this;
    }

    public function getInvestigator(): ?string
    {
        return $this->investigator;
    }

    public function setInvestigator(?string $investigator): self
    {
        $this->investigator = $investigator;

        return $this;
    }

    public function getSessionDate(): ?\DateTimeInterface
    {
        return $this->sessionDate;
    }

    public function setSessionDate(?\DateTimeInterface $sessionDate): self
    {
        $this->sessionDate = $sessionDate;

        return $this;
    }

    public function getBlame(): ?string
    {
        return $this->blame;
    }

    public function setBlame(?string $blame): self
    {
        $this->blame = $blame;

        return $this;
    }

    public function getVerdict(): ?string
    {
        return $this->verdict;
    }

    public function setVerdict(?string $verdict): self
    {
        $this->verdict = $verdict;

        return $this;
    }

    public function getVerdictDate(): ?\DateTimeInterface
    {
        return $this->verdictDate;
    }

    public function setVerdictDate(?\DateTimeInterface $verdictDate): self
    {
        $this->verdictDate = $verdictDate;

        return $this;
    }

    public function getRehabilitation(): ?string
    {
        return $this->rehabilitation;
    }

    public function setRehabilitation(?string $rehabilitation): self
    {
        $this->rehabilitation = $rehabilitation;

        return $this;
    }

    public function getNotes(): ?string
    {
        return $this->notes;
    }

    public function setNotes(?string $notes): self
    {
        $this->notes = $notes;

        return $this;
    }

    public function getRankInPast(): ?string
    {
        return $this->rankInPast;
    }

    public function setRankInPast(?string $rankInPast): self
    {
        $this->rankInPast = $rankInPast;

        return $this;
    }

    public function getList(): ?DataList
    {
        return $this->list;
    }

    public function setList(?DataList $list): self
    {
        $this->list = $list;

        return $this;
    }

    public function getSocialStatus(): ?SocialStatus
    {
        return $this->socialStatus;
    }

    public function setSocialStatus(?SocialStatus $socialStatus): self
    {
        $this->socialStatus = $socialStatus;

        return $this;
    }

    public function getNationality(): ?Nationality
    {
        return $this->nationality;
    }

    public function setNationality(?Nationality $nationality): self
    {
        $this->nationality = $nationality;

        return $this;
    }

    public function getMaritalStatus(): ?MaritalStatus
    {
        return $this->maritalStatus;
    }

    public function setMaritalStatus(?MaritalStatus $maritalStatus): self
    {
        $this->maritalStatus = $maritalStatus;

        return $this;
    }

    public function getConvict(): ?ConvictOrganization
    {
        return $this->convict;
    }

    public function setConvict(?ConvictOrganization $convict): self
    {
        $this->convict = $convict;

        return $this;
    }

    public function getPresenter(): ?CourtRepresentative
    {
        return $this->presenter;
    }

    public function setPresenter(?CourtRepresentative $presenter): self
    {
        $this->presenter = $presenter;

        return $this;
    }

    /**
     * @return Collection|CourtRepresentative[]
     */
    public function getSessionParticipants(): Collection
    {
        return $this->sessionParticipants;
    }

    public function addSessionParticipant(CourtRepresentative $sessionParticipant): self
    {
        if (!$this->sessionParticipants->contains($sessionParticipant)) {
            $this->sessionParticipants[] = $sessionParticipant;
        }

        return $this;
    }

    /**
     * @return Collection|Clause[]
     */
    public function getClauses(): Collection
    {
        return $this->clauses;
    }

    public function addClause(Clause $clause): self
    {
        if (!$this->clauses->contains($clause)) {
            $this->clauses[] = $clause;
        }

        return $this;
    }
}
