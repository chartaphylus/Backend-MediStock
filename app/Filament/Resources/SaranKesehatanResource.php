<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SaranKesehatanResource\Pages;
use App\Filament\Resources\SaranKesehatanResource\RelationManagers;
use App\Models\SaranKesehatan;
use Filament\Forms;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;

class SaranKesehatanResource extends Resource
{
    protected static ?string $model = SaranKesehatan::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document';

    protected static ?string $navigationGroup = 'Saran Kesehatan';

    protected static ?string $label = 'Saran Kesehatan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('judul')->required()->maxLength(255),
                Textarea::make('isi')->required()->rows(5),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('judul')->searchable()->sortable(),
                TextColumn::make('isi')->limit(50),
                TextColumn::make('created_at')->dateTime(),
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
            'index' => Pages\ListSaranKesehatans::route('/'),
            'create' => Pages\CreateSaranKesehatan::route('/create'),
            'edit' => Pages\EditSaranKesehatan::route('/{record}/edit'),
        ];
    }
}
