<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TagRepository")
 */
class Tag
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $tagname;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Question", mappedBy="tags")
     */
    private $questions;

    public function __construct()
    {
        $this->questions = new ArrayCollection();
    }

      public function __toString()
      {
          return $this->getTagname();
      }

    public function getId()
    {
        return $this->id;
    }

    public function getTagname(): ?string
    {
        return $this->tagname;
    }

    public function setTagname(string $tagname): self
    {
        $this->tagname = $tagname;

        return $this;
    }

    /**
     * @return Collection|Question[]
     */
    public function getQuestions(): Collection
    {
        return $this->questions;
    }

    public function addQuestion(Question $question): self
    {
        if (!$this->questions->contains($question)) {
            $this->questions[] = $question;
            $question->addTag($this);
        }

        return $this;
    }

    public function removeQuestion(Question $question): self
    {
        if ($this->questions->contains($question)) {
            $this->questions->removeElement($question);
            $question->removeTag($this);
        }

        return $this;
    }
}
