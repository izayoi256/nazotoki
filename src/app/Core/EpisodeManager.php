<?php

namespace App\Core;

use Illuminate\Session\Store as SessionStore;

final class EpisodeManager
{
    private const SESSION_KEY = 'episode';

    /** @var SessionStore */
    private $session;

    private function session(): SessionStore
    {
        return $this->session ?? ($this->session = request()->session());
    }

    public function episode(): ?array
    {
        return $this->session()->get(static::SESSION_KEY);
    }

    public function hasEpisode(): bool
    {
        return $this->session()->has(static::SESSION_KEY);
    }

    public function newEpisode(): array
    {
        $now = now()->toDateTimeImmutable();
        $this->session()->put(static::SESSION_KEY, [
            'expiresAt' => $now->modify(sprintf('+%d seconds', config('app.episode_expires_in'))),
            'progress' => 1,
        ]);
        return $this->episode();
    }

    public function clearEpisode(): array
    {
        return $this->session()->remove(static::SESSION_KEY);
    }

    public function progress(): ?int
    {
        return $this->episode()['progress'] ?? null;
    }

    public function step(): ?int
    {
        $progress = $this->progress();

        if ($progress === null) {
            return null;
        }

        return strlen(ltrim(decbin($progress), '0'));
    }

    public function passStep(int $step): void
    {
        $episode = $this->episode();
        $progress = $this->progress();

        if ($episode === null || $progress === null) {
            return;
        }

        $episode['progress'] = $progress | (1 << $step);
        $this->session()->put(self::SESSION_KEY, $episode);
    }

    public function expiresAt(): ?\DateTimeImmutable
    {
        return $this->episode()['expiresAt'] ?? null;
    }

    public function expiresIn(): ?int
    {
        $expiresAt = $this->expiresAt();

        if ($expiresAt === null) {
            return null;
        }

        return max(0, $expiresAt->getTimestamp() - now()->getTimestamp());
    }

    public function expired(): bool
    {
        $expiresIn = $this->expiresIn();

        if ($expiresIn === null) {
            return false;
        }

        return $expiresIn <= 0;
    }
}
