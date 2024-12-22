<?php

namespace App\Filament\Resources\UserResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TasksRelationManager extends RelationManager
{
    protected static string $relationship = 'tasks';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('project_id')
                    ->relationship(
                        'project',
                        'name',
                        modifyQueryUsing: fn(Builder $query, RelationManager $livewire): Builder =>
                        $query->whereUserId($livewire->getOwnerRecord()->id)
                    )
                    ->required()
                    ->searchable()
                    ->preload()
                    ->createOptionForm([
                        Forms\Components\TextInput::make('name')
                            ->label('Tarefa')
                            ->required()
                            ->maxLength(255),
                    ])
                    ->createOptionUsing(function (array $data, RelationManager $livewire) {
                        // $data = Arr::add($data, 'user_id', $livewire->getOwnerRecord()->id);
                        // $project = Project::create($data);
                        // return $project->getKey();

                        $project = $livewire
                            ->getOwnerRecord()
                            ->projects()
                            ->create($data);
                        return $project->getKey();
                    }),
                Forms\Components\TextInput::make('name')
                    ->label('Tarefa')
                    ->required()
                    ->maxLength(255),
                Forms\Components\RichEditor::make('description')
                    ->columnSpanFull(),
                Forms\Components\Toggle::make('completed')
                    ->required(),
                Forms\Components\Checkbox::make('created_at')
                // ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('project.name')
                    ->label('Projeto'),
                Tables\Columns\TextColumn::make('name')
                    ->label('Tarefas'),
                Tables\Columns\ToggleColumn::make('completed'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
