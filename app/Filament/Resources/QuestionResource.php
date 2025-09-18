<?php

namespace App\Filament\Resources;

use App\Filament\Resources\QuestionResource\Pages;
use App\Filament\Resources\QuestionResource\RelationManagers;
use App\Models\Question;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class QuestionResource extends Resource
{
    protected static ?string $model = Question::class;

    protected static ?string $navigationIcon = 'heroicon-o-question-mark-circle';
    protected static ?string $navigationGroup = 'Interview Management';
    protected static ?string $navigationLabel = 'Questions';
    protected static ?int $navigationSort = 2;
    
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Textarea::make('text')
                    ->label('Question Text')
                    ->required()
                    ->rows(3),

                Forms\Components\Select::make('type')
                    ->options([
                        'text' => 'Text Answer',
                        'file' => 'File Upload',
                    ])
                    ->default('text')
                    ->required(),

                Forms\Components\Textarea::make('expected_answer')
                    ->label('Expected Answer')
                    ->rows(3)
                    ->visible(fn ($get) => $get('type') === 'text'),

                Forms\Components\TextInput::make('max_marks')
                    ->numeric()
                    ->default(10)
                    ->minValue(1)
                    ->maxValue(100)
                    ->required(),
           
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('text')
                    ->label('Question Text'),
                Tables\Columns\TextColumn::make('type')
                    ->label('Question Type'),
                Tables\Columns\TextColumn::make('expected_answer')
                    ->label('Expected Answer'),
                Tables\Columns\TextColumn::make('max_marks')
                    ->label('Max Marks'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListQuestions::route('/'),
            'create' => Pages\CreateQuestion::route('/create'),
            'edit' => Pages\EditQuestion::route('/{record}/edit'),
        ];
    }
}
