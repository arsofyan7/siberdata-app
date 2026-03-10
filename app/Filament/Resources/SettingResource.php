<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SettingResource\Pages;
use App\Filament\Resources\SettingResource\RelationManagers;
use App\Models\Setting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SettingResource extends Resource
{
    protected static ?string $model = Setting::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
            Forms\Components\Section::make('Identitas Pengaturan')
            ->schema([
                Forms\Components\TextInput::make('key')
                ->required()
                ->disabledOn('edit') // Key jangan diubah-ubah biar nggak pecah di frontend
                ->placeholder('Contoh: about_page'),
            ]),

            Forms\Components\Section::make('Konten Halaman About')
            ->description('Kelola Visi, Misi, dan Informasi Kontak LSP')
            ->schema([
                Forms\Components\Textarea::make('value.visi')
                ->label('Visi Lembaga')
                ->required()
                ->rows(3),

                Forms\Components\RichEditor::make('value.misi')
                ->label('Misi Lembaga')
                ->required(),

                Forms\Components\Grid::make(2)
                ->schema([
                    Forms\Components\TextInput::make('value.alamat')
                    ->label('Alamat Kantor')
                    ->default('Jalan Banda No. 30, Kota Bandung, Jawa Barat'),
                    Forms\Components\TextInput::make('value.kontak')
                    ->label('Nomor WhatsApp/Telepon')
                    ->default('+62 851-8999-8970'),
                    Forms\Components\TextInput::make('value.email')
                    ->label('Email Resmi')
                    ->default('lspsiberdata@gmail.com'),
                ]),
            ])
            ->visible(fn(Forms\Get $get) => $get('key') === 'about_page'),

            Forms\Components\Section::make('Konten Landing Page Segments')
            ->description('Kelola Statistik dan Logo Trust Badges')
            ->schema([
                Forms\Components\Repeater::make('value.stats')
                ->label('Impact Counter (Statistik)')
                ->schema([
                    Forms\Components\TextInput::make('label')
                    ->required()
                    ->label('Label (Misal: Asesor Kompeten)'),
                    Forms\Components\TextInput::make('targetValue')
                    ->required()
                    ->numeric()
                    ->label('Angka Target (Misal: 50)'),
                    Forms\Components\TextInput::make('suffix')
                    ->label('Akhiran (Misal: +)'),
                    // Using string for icon identifier in frontend mapping
                    Forms\Components\Select::make('icon')
                    ->options([
                        'Award' => 'Penghargaan / Sertifikat (Award)',
                        'Users' => 'Pengguna Muka (Users)',
                        'ShieldCheck' => 'Perlindungan (ShieldCheck)',
                        'FileText' => 'Dokumen (FileText)',
                        'UserCircle' => 'User Biasa (UserCircle)'
                    ])
                    ->required()
                    ->label('Ikon'),
                ])
                ->columns(2)
                ->collapsible(),

                Forms\Components\Repeater::make('value.partners')
                ->label('Trust Badges (Mitra / Akreditasi)')
                ->schema([
                    Forms\Components\TextInput::make('name')
                    ->required()
                    ->label('Nama Instansi (Misal: BNSP)'),
                    Forms\Components\FileUpload::make('logo')
                    ->image()
                    ->directory('partners')
                    ->required()
                    ->label('Logo Instansi'),
                ])
                ->columns(2)
                ->collapsible(),
            ])
            ->visible(fn(Forms\Get $get) => $get('key') === 'landing_page'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
            Tables\Columns\TextColumn::make('key')
            ->searchable()
            ->weight('bold'),
            Tables\Columns\TextColumn::make('updated_at')
            ->dateTime()
            ->label('Terakhir Diperbarui'),
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
            'index' => Pages\ListSettings::route('/'),
            'create' => Pages\CreateSetting::route('/create'),
            'edit' => Pages\EditSetting::route('/{record}/edit'),
        ];
    }
}
