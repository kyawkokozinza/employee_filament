<?php

namespace App\Filament\Resources;

use App\Enums\GenderEnum;
use App\Filament\Resources\EmployeeResource\Pages;
use App\Models\Employee;
use App\Models\Nrc;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Wizard\Step;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class EmployeeResource extends Resource
{
    protected static ?string $model = Employee::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationGroup = 'Human Resources';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Wizard::make([
                    Step::make('Employee Info')
                        ->schema([
                            Section::make('employees')
                                ->schema([
                                    TextInput::make('name_e')
                                        ->label('Employee Name(English)')

                                        ->live(onBlur: true),
                                    TextInput::make('name_m')
                                        ->label('Employee Name(Myanmar)')

                                        ->live(onBlur: true),
                                    TextInput::make('father_name')
                                        ->label('Father Name')

                                        ->live(onBlur: true),

                                    DatePicker::make('date_of_birth')
                                        ->label('Date of Birth'),

                                    TextInput::make('race')
                                        ->label('Race')
                                        ->live(onBlur: true),
                                    Select::make('religion')
                                        ->options([
                                            // "Buddhist" => ReligionEnum::BUDDHISM->value,
                                            // "Christianity" => ReligionEnum::CHRISTIANITY->value,
                                            // "Islam" => ReligionEnum::ISLAM->value,
                                            // "Hunduism" => ReligionEnum::HINDUISM->value,
                                            // "Other" => ReligionEnum::OTHER->value,
                                            // "No Religion" => ReligionEnum::NORELIGION->value,
                                            "Buddhist" => "Buddhist",
                                            "Christianity" => "Christianity",
                                            "Islam" => "Islam",
                                            "Hunduism" => "Hunduism",
                                            "Other" => "Other",
                                            "No Religion" => "No Religion",

                                        ]),

                                    Select::make('nationality')
                                        ->options([
                                            // "Kachin" => NationalityEnum::KACHIN->value,
                                            // "Kayah" => NationalityEnum::KAYAH->value,
                                            // "Kayin" => NationalityEnum::KAYIN->value,
                                            // "Chin" => NationalityEnum::CHIN->value,
                                            // "Burma" => NationalityEnum::BURMA->value,
                                            // "Mon" => NationalityEnum::MON->value,
                                            // "Rakhine" => NationalityEnum::RAKHINE->value,
                                            // "Shan" => NationalityEnum::SHAN->value,
                                            "Kachin" => "Kachin",
                                            "Kayah" => "Kayah",
                                            "Kayin" => "Kayin",
                                            "Chin" => "Chin",
                                            "Burma" => "Burma",
                                            "Mon" => "Mon",
                                            "Rakhine" => "Rakhine",
                                            "Shan" => "Shan",
                                        ]),
                                    Select::make('vacancy')
                                        ->options([
                                            // "Junior Web Developer" => VacancyEnum::JUNIORWEBDEVELOPER->value,
                                            // "Web Developer" => VacancyEnum::WEBDEVELOPER->value,
                                            // "Web Designer" => VacancyEnum::WEBDESIGNER->value,
                                            "Junior Web Developer" => "Junior Web Developer",
                                            "Web Developer" => "Web Developer",
                                            "Web Designer" => "Web Designer",
                                        ]),
                                    TextInput::make('passport_no')
                                        ->label('Passport No')
                                        ->live(onBlur: true),

                                    TextInput::make('driver_license')
                                        ->label('Driver License')
                                        ->live(onBlur: true),

                                    Fieldset::make('NRC')
                                        ->schema([
                                            Select::make('nrcs_id')
                                                ->label('Code')
                                                ->options(Nrc::select('nrc_code')->distinct()->orderBy('nrc_code', 'asc')->pluck('nrc_code'))
                                                ->live()
                                                ->afterStateUpdated(fn(Set $set, ?string $state) => $set('name_en', Nrc::select('name_en')->where('nrc_code', ++$state)->pluck('name_en'))),

                                            Select::make('nrcs_n')
                                                ->label('distinct')
                                                ->options(function ($get) {
                                                    return $get('name_en');}),

                                            Select::make('type')
                                                ->label('Type')
                                                ->options([
                                                    // "N" => TypeEnum::N->value,
                                                    // "P" => TypeEnum::P->value,
                                                    // "A" => TypeEnum::A->value,
                                                    "N" => "N",
                                                    "P" => "P",
                                                    "A" => "A",
                                                ]),

                                            TextInput::make('nrc_num')
                                                ->label('Number')
                                                ->live(onBlur: true),
                                        ])->columns(4)->columnSpan(1),

                                    Select::make('gender')
                                        ->options([
                                            "Male" => GenderEnum::MALE->value,
                                            "Female" => GenderEnum::FAMALE->value,
                                        ]),
                                    Select::make('blood')
                                        ->options([
                                            // "A" => BloodTypeEnum::A->value,
                                            // "B" => BloodTypeEnum::B->value,
                                            // "AB" => BloodTypeEnum::AB->value,
                                            // "O" => BloodTypeEnum::O->value,
                                            "A" => "A",
                                            "B" => "B",
                                            "AB" => "AB",
                                            "O" => "O",
                                        ]),
                                    Select::make('marital')
                                        ->options([
                                            // "single" => MaritalStatusEnum::SINGLE->value,
                                            // "married" => MaritalStatusEnum::MARRIED->value,
                                            "Single" => "Single",
                                            "Married" => "Married",
                                        ]),

                                    TextInput::make('hphone_no')
                                        ->label('Home Phone')

                                        ->live(onBlur: true),
                                    TextInput::make('phone_no')
                                        ->label('Mobile Phone')

                                        ->live(onBlur: true),
                                    TextInput::make('url')
                                        ->label('URL')
                                        ->placeholder('Social Media Url(eg. facebook,twitter,instagram,etc)')
                                        ->live(onBlur: true)
                                        ->columnSpan(2),

                                ])->columns(3),
                        ]),
                    Step::make('Education Info')
                        ->schema([
                            Repeater::make('education')
                                ->label('Education')
                                ->relationship()
                                ->schema([
                                    TextInput::make('degree')
                                        ->label('Education/Degree')
                                        ->live(onBlur: true)
                                        ->columnSpan(2),
                                    DatePicker::make('from_date')
                                        ->label('From'),
                                    DatePicker::make('to_date')
                                        ->label('To'),
                                    TextInput::make('university')
                                        ->label('School/College/University')
                                        ->live(onBlur: true)
                                        ->columnSpan(2),
                                ])->columns(6),
                            Repeater::make('work')
                                ->label('Work Experience')
                                ->relationship()
                                ->schema([
                                    TextInput::make('title')
                                        ->label('Job Title')
                                        ->live(onBlur: true)
                                        ->columnSpan(2),
                                    TextInput::make('company')
                                        ->label('Company Name')
                                        ->live(onBlur: true)
                                        ->columnSpan(2),
                                    DatePicker::make('from_date')
                                        ->label('From'),
                                    DatePicker::make('to_date')
                                        ->label('To'),
                                    TextInput::make('employer_phno')
                                        ->label('Employer Contact')
                                        ->placeholder('Employer Contact eg.(09876765423)')
                                        ->live(onBlur: true)
                                        ->columnSpan(2),
                                    TextInput::make('employer_address')
                                        ->label('Employer Address')
                                        ->placeholder('Employer Address')
                                        ->live(onBlur: true)
                                        ->columnSpan(4),
                                    FileUpload::make('attachment')
                                        ->label('Select Attachment')
                                        ->hint('
                                        Accepts.docx,doc,pdf up to 5MB')
                                        ->columnSpan(4),
                                ])->columns(6),
                        ]),
                    Step::make('Address')
                        ->schema([
                            Repeater::make('address')
                                ->label('Address')
                                ->relationship()
                                ->schema([
                                    TextInput::make('country')
                                        ->label('Country')
                                        ->live(onBlur: true)
                                        ->columnSpan(2),
                                    TextInput::make('state')
                                        ->label('State')
                                        ->live(onBlur: true)
                                        ->columnSpan(2),
                                    TextInput::make('township')
                                        ->label('Township')
                                        ->live(onBlur: true)
                                        ->columnSpan(2),
                                    TextInput::make('street')
                                        ->label('Street')
                                        ->live(onBlur: true)
                                        ->columnSpan(2),
                                ])->columns(4),
                        ]),
                ])->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name_e')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('gender')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('vacancy')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('phone_no')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('date_of_birth')
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ]),
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
            'index' => Pages\ListEmployees::route('/'),
            'create' => Pages\CreateEmployee::route('/create'),
            'edit' => Pages\EditEmployee::route('/{record}/edit'),
        ];
    }
}
