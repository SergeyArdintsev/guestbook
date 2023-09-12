<?php

namespace App\Entity;

use App\Repository\CommentRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommentRepository::class)]
class Comment
{
    /**
     * @var int|null The ID of the object.
     */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * @var string|null The author
     */
    #[ORM\Column(length: 255)]
    private ?string $author = null;

    /**
     * @var string|null The text
     */
    #[ORM\Column(type: Types::TEXT)]
    private ?string $text = null;

    /**
     * @var string|null The email
     */
    #[ORM\Column(length: 255)]
    private ?string $email = null;

    /**
     * @var \DateTimeImmutable|null The created at
     */
    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    /**
     * @var Conference|null The conference
     */
    #[ORM\ManyToOne(inversedBy: 'comments')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Conference $conference = null;

    /**
     * @var string|null The photo filename
     */
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $photoFilename = null;

    /**
     * Retrieves the ID of the object.
     *
     * @return int|null The ID of the object, or null if it is not set.
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Retrieves the author of the object.
     *
     * @return string|null The author of the object, or null if not set.
     */
    public function getAuthor(): ?string
    {
        return $this->author;
    }

    /**
     * Sets the author of the object.
     *
     * @param string $author The name of the author.
     * @return static The updated object.
     */
    public function setAuthor(string $author): static
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Retrieves the text.
     *
     * @return string|null The text.
     */
    public function getText(): ?string
    {
        return $this->text;
    }

    /**
     * Sets the text.
     *
     * @param string $text
     * @return $this The updated object.
     */
    public function setText(string $text): static
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Retrieves the email associated with this object.
     *
     * @return ?string The email associated with this object, or null if no email is set.
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * Sets the email for the object.
     *
     * @param string $email The email to set.
     * @return static The modified object.
     */
    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Retrieves the value of the createdAt property.
     *
     * @return \DateTimeImmutable|null The createdAt property value.
     */
    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    /**
     * Set the value of the createdAt property.
     *
     * @param \DateTimeImmutable $createdAt The new value for the createdAt property.
     * @return static Return $this for method chaining.
     */
    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Retrieves the conference associated with the current object.
     *
     * @return Conference|null The conference associated with the current object, or null if no conference is set.
     */
    public function getConference(): ?Conference
    {
        return $this->conference;
    }

    /**
     * Sets the conference for the current object.
     *
     * @param Conference|null $conference The conference to set.
     * @return static The updated object.
     */
    public function setConference(?Conference $conference): static
    {
        $this->conference = $conference;

        return $this;
    }

    /**
     * Retrieves the filename of the photo.
     *
     * @return string|null The filename of the photo, or null if it is not set.
     */
    public function getPhotoFilename(): ?string
    {
        return $this->photoFilename;
    }

    /**
     * Sets the photo filename for the object.
     *
     * @param string|null $photoFilename The photo filename to set.
     * @return $this The object instance.
     */
    public function setPhotoFilename(?string $photoFilename): static
    {
        $this->photoFilename = $photoFilename;

        return $this;
    }
}
