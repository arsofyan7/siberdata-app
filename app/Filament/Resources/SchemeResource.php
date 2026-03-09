<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SchemeResource\Pages;
use App\Models\Scheme;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class SchemeResource extends Resource
{
    protected static ?string $model = Scheme::class;

    protected static ?string $navigationIcon = 'heroicon-o-shield-check'; // Icon kamsiber banget
    protected static ?string $navigationGroup = 'Master Data';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Skema')
                    ->description('Detail skema sertifikasi LSP Siberdata')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state))),
                        
                        Forms\Components\TextInput::make('slug')
                            ->required()
                            ->unique(ignoreRecord: true),

                        Forms\Components\TextInput::make('code')
                            ->label('Kode Skema')
                            ->required()
                            ->unique(ignoreRecord: true),

                        Forms\Components\Select::make('category')
                            ->options([
                                'cyber' => 'Cyber Security',
                                'pdp' => 'Pelindungan Data Pribadi (PDP)',
                            ])
                            ->required(),

                        Forms\Components\Select::make('level')
                            ->options(array_combine(range(3, 8), range(3, 8)))
                            ->required(),

                        Forms\Components\Toggle::make('is_active')
                            ->label('Aktif')
                            ->default(true),

                        Forms\Components\RichEditor::make('description')
                            ->columnSpanFull(),
                    ])->columns(2),

                Forms\Components\Section::make('Informasi Detail (JSON)')
                    ->description('Data detail terkait skema untuk Profil, Tugas, dan Persyaratan')
                    ->schema([
                        Forms\Components\Textarea::make('details.definisi')
                            ->label('Definisi')
                            ->rows(3)
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('details.kualifikasi')
                            ->label('Kualifikasi')
                            ->rows(3)
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('details.lingkup_bidang')
                            ->label('Lingkup Bidang')
                            ->rows(3)
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('details.profil')
                            ->label('Profil')
                            ->rows(3)
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('details.tanggung_jawab')
                            ->label('Tanggung Jawab')
                            ->rows(3)
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('details.wewenang')
                            ->label('Wewenang')
                            ->rows(3)
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('details.persyaratan')
                            ->label('Persyaratan')
                            ->rows(3)
                            ->columnSpanFull(),
                        Forms\Components\TagsInput::make('details.tugas')
                            ->label('Tugas')
                            ->separator(',')
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('details.jenjang_karier')
                            ->label('Jenjang Karier')
                            ->rows(2)
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('details.sertifikasi')
                            ->label('Sertifikasi')
                            ->rows(2)
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('details.verifikasi')
                            ->label('Metode Verifikasi')
                            ->rows(2)
                            ->columnSpanFull(),
                    ])->collapsible(),
            ]);
    }


        public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('code')
                    ->label('Kode')
                    ->searchable()
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Skema')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\BadgeColumn::make('category')
                    ->colors([
                        'primary' => 'cyber',
                        'success' => 'pdp',
                    ]),

                Tables\Columns\TextColumn::make('level')
                    ->sortable(),

                Tables\Columns\ToggleColumn::make('is_active')
                    ->label('Status'),

                Tables\Columns\TextColumn::make('details.definisi')
                    ->label('Definisi Skema')
                    ->limit(50)
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category')
                    ->options([
                        'cyber' => 'Cyber Security',
                        'pdp' => 'PDP',
                    ]),
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


    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSchemes::route('/'),
            'create' => Pages\CreateScheme::route('/create'),
            'edit' => Pages\EditScheme::route('/{record}/edit'),
        ];
    }
}