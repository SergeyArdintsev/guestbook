<?php

namespace App\Entity;

use App\Repository\ConferenceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ConferenceRepository::class)]
class Conference
{
    /**
     * @var int|null The ID of the object.
     */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * @var string|null The city
     */
    #[ORM\Column(length: 255)]
    private ?string $city = null;

    /**
     * @var string|null The year
     */
    #[ORM\Column(length: 4)]
    private ?string $year = null;

    /**
     * @var bool|null Whether the conference is international
     */
    #[ORM\Column]
    private ?bool $isInternational = null;

    /**
     * @var Collection|ArrayCollection Collection of comments
     */
    #[ORM\OneToMany(mappedBy: 'conference', targetEntity: Comment::class, orphanRemoval: true)]
    private Collection $comments;

    /**
     * Constructor for the class.
     *
     * Initializes the comments property with an empty ArrayCollection.
     *
     * @return void
     */
    public function __construct()
    {
        $this->comments = new ArrayCollection();
    }

    /**
     * Converts the object to a string representation.
     *
     * @return string The string representation of the object.
     */
    public function __toString()
    {
        return $this->city.' '.$this->year;
    }

    /**
     * Retrieves the ID of the object.
     *
     * @return int|null The ID of the object, or null if it doesn't have one.
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Retrieves the city associated with this object.
     *
     * @return string|null The city associated with this object, or null if no city is set.
     */
    public function getCity(): ?string
    {
        return $this->city;
    }

    /**
     * Sets the city for the object.
     *
     * @param string $city The city to set.
     * @return static Returns the updated object.
     */
    public function setCity(string $city): static
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Retrieves the year.
     *
     * @return ?string The year.
     */
    public function getYear(): ?string
    {
        return $this->year;
    }

    /**
     * Sets the year for the object.
     *
     * @param string $year The year to set.
     * @return static The updated object.
     */
    public function setYear(string $year): static
    {
        $this->year = $year;

        return $this;
    }

    /**
     * Returns the value of the $isInternational property.
     *
     * @return bool|null The value of the $isInternational property.
     */
    public function isIsInternational(): ?bool
    {
        return $this->isInternational;
    }

    /**
     * Sets the value of the $isInternational property.
     *
     * @param bool $isInternational The new value for the $isInternational property.
     * @return static The updated object.
     */
    public function setIsInternational(bool $isInternational): static
    {
        $this->isInternational = $isInternational;

        return $this;
    }

    /**
     * Retrieve the comments associated with this object.
     *
     * @return Collection<int, Comment> The collection of comments.
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    /**
     * Adds a comment to the current conference.
     *
     * @param Comment $comment The comment to be added.
     * @return static Returns the updated Conference object.
     */
    public function addComment(Comment $comment): static
    {
        if (!$this->comments->contains($comment)) {
            $this->comments->add($comment);
            $comment->setConference($this);
        }

        return $this;
    }

    /**
     * Removes a comment from the comment collection.
     *
     * @param Comment $comment The comment to be removed.
     * @return static Returns an instance of the class.
     */
    public function removeComment(Comment $comment): static
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getConference() === $this) {
                $comment->setConference(null);
            }
        }

        return $this;
    }
}
