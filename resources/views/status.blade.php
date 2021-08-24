@extends('statamic::layout')

@section('title', __('Git Sync'))

@section('content')

    <div class="page-wrapper max-w-xl">
        <header class="mb-3"><h1>Git Sync</h1></header>
        <div class="card p-2 content">
            <div class="">
                <p>You are currently on the <code class="mx-1">{{ $current }}</code> branch.</p>

                <div class="block my-4">
                    <header><h2>Pull</h2></header>
                    @if($pending->count() > 0)
                    <p>You have pending changes:</p>
                    <div class="bg-grey-20 p-2 my-2 text-xs font-mono">
                    @foreach($pending as $file)
                        @if($file->isCreation())
                        <div class="text-green">C {{ $file->getName() }}</div>
                        @elseif($file->isRename())
                        <div class="text-blue">R {{ $file->getOldName() }} -> {{ $file->getOldName() }}</div>
                        @elseif($file->isDeletion())
                        <div class="text-red">D {{ $file->getName() }}</div>
                        @elseif($file->isModification())
                        <div class="text-orange">M {{ $file->getName() }}</div>
                        @else
                        <div>{{ $file->getName() }}</div>
                        @endif
                    @endforeach
                    </div>
                    @endif
                    <form action="" method="post">
                        <button class="btn btn-primary">
                            @if($pending->count() > 0)
                            Discard changes and pull
                            @else
                            Pull latest changes
                            @endif
                        </button>

                        @if($pending->count() > 0)
                        <button class="btn btn-secondary">
                            I want to push these changes
                        </button>
                        @endif
                    </form>
                </div>

                @if($pending->count() > 0)
                <div class="block my-4">
                    <header><h2>Push</h2></header>
                    <div class="bg-grey-20 p-2 text-xs font-mono">
                    @foreach($pending as $file)
                        @if($file->isCreation())
                        <div class="text-green">C {{ $file->getName() }}</div>
                        @elseif($file->isRename())
                        <div class="text-blue">R {{ $file->getOldName() }} -> {{ $file->getOldName() }}</div>
                        @elseif($file->isDeletion())
                        <div class="text-red">D {{ $file->getName() }}</div>
                        @elseif($file->isModification())
                        <div class="text-orange">M {{ $file->getName() }}</div>
                        @else
                        <div>{{ $file->getName() }}</div>
                        @endif
                    @endforeach
                    </div>
                    <form action="" method="post">
                        <div class="my-2">
                            <label>Commit message</label>
                            <textarea name="message" class="w-full border p-1 resize-none" rows="2"></textarea>
                            <label class="flex items-center gap-1"><input type="checkbox" name="force" value="1">Force push</label>
                        </div>
                        <button class="btn btn-primary">
                            Commit and push changes
                        </button>
                        <button class="btn btn-secondary">
                            Cancel
                        </button>
                    </form>
                </div>
                @endif

            </div>
        </div>
    </div>

@endsection