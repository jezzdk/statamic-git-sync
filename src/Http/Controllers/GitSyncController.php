<?php

namespace Jezzdk\StatamicGitSync\Http\Controllers;

use Gitonomy\Git\Repository as GitRepository;
use Illuminate\Http\JsonResponse;

class GitSyncController
{
    protected $repository;

    public function __construct(GitRepository $git)
    {
        $this->repository = $git;
    }

    public function status()
    {
        $wc = $this->repository->getWorkingCopy();

        $pending = $wc->getDiffPending()->getFiles();

        /*$head = $this->repository->getHead(); // Commit or Reference
        dump($head);
        $head = $this->repository->getHeadCommit(); // Commit
        dump($head);

        dump($this->repository->isHeadDetached());

        $references = $this->repository->getReferences();
        $branches = $references->getBranches();
        dump($branches);

        foreach ($branches as $branch) {
            dump($branch->isLocal());
        }*/
        $current = trim($this->repository->run('branch', ['--show-current']));

        return view('statamic-git-sync::status', [
            'current' => $current,
            'pending' => collect($pending),
            //'staged' => $staged,
            //'pending' => $pending,
        ]);
    }

    public function push(): JsonResponse
    {
        $result = $this->repository->run('push');

        return response()->json(['result' => $result]);
    }

    public function pull(): JsonResponse
    {
        $result = $this->repository->run('pull');

        return response()->json(['result' => $result]);
    }
}
