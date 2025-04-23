<?php

class Participation
{
    private int $id_participation;
    private int $idE;
    private string $nom_participant;
    private string $prenom_participant;
    private string $numTel_participant;
    private string $mail_participant;

    // Constructeur sans ID (utile pour insertion)
    public function __construct(
        int $idE,
        string $nom_participant,
        string $prenom_participant,
        string $numTel_participant,
        string $mail_participant,
    ) {
        $this->idE = $idE;
        $this->nom_participant = $nom_participant;
        $this->prenom_participant = $prenom_participant;
        $this->numTel_participant = $numTel_participant;
        $this->mail_participant = $mail_participant;
    }
    

    // Getters
    public function getIdParticipation(): int
    {
        return $this->id_participation;
    }

    public function getIdE(): int
    {
        return $this->idE;
    }

    public function getNomParticipant(): string
    {
        return $this->nom_participant;
    }

    public function getPrenomParticipant(): string
    {
        return $this->prenom_participant;
    }

    public function getNumTelParticipant(): string
    {
        return $this->numTel_participant;
    }

    public function getMailParticipant(): string
    {
        return $this->mail_participant;
    }

    // Setters
    public function setIdParticipation(int $id): void
    {
        $this->id_participation = $id;
    }

    public function setIdE(int $idE): void
    {
        $this->idE = $idE;
    }

    public function setNomParticipant(string $nom): void
    {
        $this->nom_participant = $nom;
    }

    public function setPrenomParticipant(string $prenom): void
    {
        $this->prenom_participant = $prenom;
    }

    public function setNumTelParticipant(string $numTel): void
    {
        $this->numTel_participant = $numTel;
    }

    public function setMailParticipant(string $mail): void
    {
        $this->mail_participant = $mail;
    }
}
