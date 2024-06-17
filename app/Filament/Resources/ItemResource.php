<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ItemResource\Pages;
use App\Filament\Resources\ItemResource\RelationManagers;
use App\Models\Item;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\Concerns\Translatable;

class ItemResource extends Resource
{
    use Translatable;
    protected static ?string $model = Item::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('x')
                    ->numeric(),
                Forms\Components\TextInput::make('y')
                    ->numeric(),
                Forms\Components\TextInput::make('span_x')
                    ->numeric(),
                Forms\Components\TextInput::make('span_y')
                    ->numeric(),
                Forms\Components\TextInput::make('title'),
                Forms\Components\TextInput::make('author'),
                Forms\Components\TextInput::make('dating'),
                Forms\Components\TextInput::make('medium'),
                Forms\Components\TextInput::make('measurement'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->searchable(),
                Tables\Columns\TextColumn::make('x')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('y')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('span_x')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('span_y')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\Action::make('API')->label('API')->icon('heroicon-o-code-bracket')->url(fn ($record) => route('api.items.show', $record->id))->openUrlInNewTab()->color('secondary'),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListItems::route('/'),
            'create' => Pages\CreateItem::route('/create'),
            'edit' => Pages\EditItem::route('/{record}/edit'),
        ];
    }
}
