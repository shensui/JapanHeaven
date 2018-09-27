<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MangaRepository")
 * @Gedmo\SoftDeleteable(fieldName="deleteAt", timeAware=false)
 */
class Manga
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
    private $title;

    /**
     * @var string
     * @Gedmo\Slug(fields={"title"})
     * @ORM\Column(name="slug", type="string", length=255, unique=true)
     */
    private $slug;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Range(
     *     min="1989"
     * )
     */
    private $year;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $auteur;

    /**
     * @ORM\Column(type="integer")
     */
    private $chapTotale;

    /**
     * @var string
     *
     * @ORM\Column(name="synopsie", type="text")
     */
    private $synopsie;

    /**
     * @var string
     *
     * @ORM\Column(name="lel", type="string", length=255)
     */
    private $lel;

    /**
     * @ORM\Column(type="boolean")
     */
    private $online;

    /**
     * @var \DateTime
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="created", type="datetime")
     */
    private $created;

    /**
     * @var \DateTime
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(name="updated", type="datetime")
     */
    private $updated;

    /**
     * @var dateTime
     *
     * @ORM\Column(name="deleteAt", type="datetime", nullable=true)
     */
    private $deleteAt;

    //les liaison

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Genre")
     */
    private $genres;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Type")
     * @ORM\JoinColumn(nullable=false)
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Etats")
     * @ORM\JoinColumn(nullable=false)
     */
    private $etatsParution;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Image", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $cover;

    /**
     * Manga constructor.
     */
    public function __construct()
    {
        $this->online = false;
        $this->genres = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     * @return null|void
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     */
    public function setSlug(string $slug)
    {
        $this->slug = $slug;
    }

    /**
     * @return mixed
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * @param mixed $year
     */
    public function setYear($year)
    {
        $this->year = $year;
    }

    /**
     * @return mixed
     */
    public function getAuteur()
    {
        return $this->auteur;
    }

    /**
     * @param mixed $auteur
     */
    public function setAuteur($auteur)
    {
        $this->auteur = $auteur;
    }

    /**
     * @return mixed
     */
    public function getChapTotale()
    {
        return $this->chapTotale;
    }

    /**
     * @param mixed $chapTotale
     */
    public function setChapTotale($chapTotale)
    {
        $this->chapTotale = $chapTotale;
    }

    /**
     * @return string
     */
    public function getSynopsie()
    {
        return $this->synopsie;
    }

    /**
     * @param string $synopsie
     */
    public function setSynopsie(string $synopsie)
    {
        $this->synopsie = $synopsie;
    }

    /**
     * @return string
     */
    public function getLel()
    {
        return $this->lel;
    }

    /**
     * @param string $lel
     */
    public function setLel(string $lel)
    {
        $this->lel = $lel;
    }

    /**
     * @return mixed
     */
    public function getOnline()
    {
        return $this->online;
    }

    /**
     * @param mixed $online
     */
    public function setOnline($online)
    {
        $this->online = $online;
    }

    /**
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param \DateTime $created
     */
    public function setCreated(\DateTime $created)
    {
        $this->created = $created;
    }

    /**
     * @return \DateTime
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * @param \DateTime $updated
     */
    public function setUpdated(\DateTime $updated)
    {
        $this->updated = $updated;
    }

    /**
     * @return dateTime
     */
    public function getDeleteAt()
    {
        return $this->deleteAt;
    }

    /**
     * @param dateTime $deleteAt
     */
    public function setDeleteAt(dateTime $deleteAt)
    {
        $this->deleteAt = $deleteAt;
    }

    /**
     * @return Collection|Genre[]
     */
    public function getGenres()
    {
        return $this->genres;
    }

    public function addGenre(Genre $genre)
    {
        if (!$this->genres->contains($genre)) {
            $this->genres[] = $genre;
        }

        return $this;
    }

    public function removeGenre(Genre $genre)
    {
        if ($this->genres->contains($genre)) {
            $this->genres->removeElement($genre);
        }

        return $this;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getEtatsParution()
    {
        return $this->etatsParution;
    }

    /**
     * @param mixed $etatsParution
     */
    public function setEtatsParution($etatsParution)
    {
        $this->etatsParution = $etatsParution;
    }

    /**
     * @return mixed
     */
    public function getCover()
    {
        return $this->cover;
    }

    /**
     * @param mixed $cover
     */
    public function setCover($cover)
    {
        $this->cover = $cover;
    }

    public function interval(){
        $tz = new \DateTimeZone('Europe/Paris');
        $DateCreated = $this->getCreated();// la datte d'ajout
        $DateNow     = new \DateTime("now", $tz);//aujourd'hui
        $Interval = $DateNow->diff($DateCreated);

        if($Interval->i > 0 && $Interval->i < 60){
            $create=$Interval->i." minute.";
        }if($Interval->h > 0 && $Interval->h < 24){
            $create=$Interval->h." heure.";
        }if($Interval->d > 0 && $Interval->d < 31){
            $create=$Interval->d." jours.";
        }if($Interval->m > 0 && $Interval->m < 12){
            $create=$Interval->m." moi.";
        }if($Interval->y > 0){
            $create=$Interval->y." ans.";
        }

        return $create;
    }
}
