<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PatientResource\Pages;
use App\Filament\Resources\PatientResource\RelationManagers;
use App\Models\Patient;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PatientResource extends Resource
{
    protected static ?string $model = Patient::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    protected static ?string $navigationLabel = 'Paciente'; // Altera o texto no menu
    protected static ?string $modelLabel = 'Paciente'; // Para uso singular
    protected static ?string $pluralModelLabel = 'Pacientes'; // Para uso plural


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nome')
                            ->required()
                            ->helperText(str('Colocar o **Nome completo** do paciente aqui.')->inlineMarkdown()->toHtmlString())
                            ->maxLength(255),
                        Forms\Components\TextInput::make('cpf')
                            ->label('CPF')
                            ->mask('999.999.999-99')
                            ->required()
                            ->maxLength(14),
                        Forms\Components\Toggle::make('enable_social_name')
                            ->label('Habilitar Nome Social')
                            ->helperText(str('De acordo com a LEI ...')->inlineMarkdown()->toHtmlString())
                            ->reactive(), // Torna o botão dinâmico
                        Forms\Components\TextInput::make('social_name')
                            ->label('Nome Social') // Exibe o rótulo em português
                            ->maxLength(255)
                            ->disabled(fn (callable $get) => !$get('enable_social_name')), // Desabilita com base no toggle
                    ])
                ->columns(2) // Dois campos por linha
                ->columnSpan('full') // Card ocupa toda a largura
                ->label('Dados Pessoais'),

                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\Select::make('sex')
                            ->label('Sexo')
                            ->options([
                                'masculino' => 'Masculino',
                                'feminino' => 'Feminino',
                            ]),
                        Forms\Components\Select::make('breed')
                            ->label('Raça')
                            ->options([
                                'branco' => 'Branco',
                                'pardo' => 'Pardo',
                                'preto' => 'Preto',
                                'indigena' => 'Indígena',
                                'amarelo' => 'Amarelo',
                            ]),
                        Forms\Components\DatePicker::make('birth_date')
                            ->label('Data de nascimento')
                            ->displayFormat('d/m/Y') // Formato de exibição
                            ->format('Y-m-d'),
                        Forms\Components\TextInput::make('cns')
                            ->label('CNS')
                            ->mask('999 9999 9999 9999')
                            ->helperText(str('Colocar a **Carteira Nacional do SUS** do paciente aqui.')->inlineMarkdown()->toHtmlString())
                            ->maxLength(18),
                        Forms\Components\TextInput::make('phone')
                            ->label('Telefone Celular')
                            ->mask('(99) 99999 9999')
                            ->maxLength(15),
                        
                    ])
                    ->columns(3)
                    ->columnSpan('full')
                    ->label('Dados Complementares'),


                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\TextInput::make('rg')
                            ->label('RG')
                            ->helperText(str('Colocar o **RG** não obrigatório.')->inlineMarkdown()->toHtmlString())
                            ->maxLength(18),
                        Forms\Components\Select::make('uf_rg')
                            ->label('Unidade federativa do RG')
                            ->options([
                                'AC' => 'Acre (AC)',
                                'AL' => 'Alagoas (AL)',
                                'AP' => 'Amapá (AP)',
                                'AM' => 'Amazonas (AM)',
                                'BA' => 'Bahia (BA)',
                                'CE' => 'Ceará (CE)',
                                'ES' => 'Espírito Santo (ES)',
                                'GO' => 'Goiás (GO)',
                                'MA' => 'Maranhão (MA)',
                                'MT' => 'Mato Grosso (MT)',
                                'MS' => 'Mato Grosso do Sul (MS)',
                                'MG' => 'Minas Gerais (MG)',
                                'PA' => 'Pará (PA)',
                                'PB' => 'Paraíba (PB)',
                                'PR' => 'Paraná (PR)',
                                'PE' => 'Pernambuco (PE)',
                                'PI' => 'Piauí (PI)',
                                'RJ' => 'Rio de Janeiro (RJ)',
                                'RN' => 'Rio Grande do Norte (RN)',
                                'RS' => 'Rio Grande do Sul (RS)',
                                'RO' => 'Rondônia (RO)',
                                'RR' => 'Roraima (RR)',
                                'SC' => 'Santa Catarina (SC)',
                                'SP' => 'São Paulo (SP)',
                                'SE' => 'Sergipe (SE)',
                                'TO' => 'Tocantins (TO)',
                                'DF' => 'Distrito Federal (DF)',
                            ]),
                        Forms\Components\TextInput::make('expediter')
                            ->label('Despachante')
                            ->helperText(str('Exemplo **SSP-AP** (não obrigatório).')->inlineMarkdown()->toHtmlString())
                            ->maxLength(15),
                        Forms\Components\Select::make('marital_status')
                            ->label('Estado Civil')
                            ->options([
                                'solteiro' => 'Solteiro',
                                'casado' => 'Casado',
                                'viuvo' => 'Viúvo',
                                'divorciado' => 'Divorciado',
                                'separado' => 'Separado judicialmente',
                            ]),
                        Forms\Components\Select::make('nationallity')
                            ->label('Nacionalidade')
                            ->options([
                                'brasileiro' => 'Brasileiro',
                                'naturalizado' => 'Naturalizado',
                                'outro pais' => 'Outro país',
                            ]),
                        Forms\Components\TextInput::make('naturalness')
                            ->label('Naturalidade')
                            ->helperText(str('Colocar a **Cidade** onde o paciente nasceu.')->inlineMarkdown()->toHtmlString())
                            ->maxLength(18),
                        Forms\Components\Select::make('uf_naturalness')
                            ->label('Unidade federativa do paciente')
                            ->options([
                                'AC' => 'Acre (AC)',
                                'AL' => 'Alagoas (AL)',
                                'AP' => 'Amapá (AP)',
                                'AM' => 'Amazonas (AM)',
                                'BA' => 'Bahia (BA)',
                                'CE' => 'Ceará (CE)',
                                'ES' => 'Espírito Santo (ES)',
                                'GO' => 'Goiás (GO)',
                                'MA' => 'Maranhão (MA)',
                                'MT' => 'Mato Grosso (MT)',
                                'MS' => 'Mato Grosso do Sul (MS)',
                                'MG' => 'Minas Gerais (MG)',
                                'PA' => 'Pará (PA)',
                                'PB' => 'Paraíba (PB)',
                                'PR' => 'Paraná (PR)',
                                'PE' => 'Pernambuco (PE)',
                                'PI' => 'Piauí (PI)',
                                'RJ' => 'Rio de Janeiro (RJ)',
                                'RN' => 'Rio Grande do Norte (RN)',
                                'RS' => 'Rio Grande do Sul (RS)',
                                'RO' => 'Rondônia (RO)',
                                'RR' => 'Roraima (RR)',
                                'SC' => 'Santa Catarina (SC)',
                                'SP' => 'São Paulo (SP)',
                                'SE' => 'Sergipe (SE)',
                                'TO' => 'Tocantins (TO)',
                                'DF' => 'Distrito Federal (DF)',
                            ]),
                    ])
                    ->columns(3)
                    ->columnSpan('full')
                    ->label('Dados Complementares'),
                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\TextInput::make('cep')
                            ->label('CEP')
                            ->numeric()
                            ->mask('99999999')
                            ->maxLength(8)
                            ->reactive()
                            ->afterStateUpdated(function ($state, callable $set) {
                                $state = str_replace(['.', '-'], '', $state);
                                if (strlen($state) === 8) {
                                    $url = "https://viacep.com.br/ws/{$state}/json/";
                                    $client = new \GuzzleHttp\Client();
                                    try {
                                        $response = $client->get($url);
                                        $data = json_decode($response->getBody(), true);
                                        
                                        if (!isset($data['erro'])) {
                                            $set('street', strtoupper($data['logradouro'] ?? ''));
                                            $set('complement', strtoupper($data['complemento'] ?? ''));
                                            $set('district', strtoupper($data['bairro'] ?? ''));
                                            $set('city', strtoupper($data['localidade'] ?? ''));
                                            $set('state', strtoupper($data['uf'] ?? ''));
                                        }
                                    } catch (\Exception $e) {
                                        // Tratar erro se necessário
                                    }
                                }
                            }),
                            
                        Forms\Components\TextInput::make('street')
                            ->label('Logradouro')
                            ->maxLength(60),
                            
                        Forms\Components\TextInput::make('complement')
                            ->label('Complemento')
                            ->maxLength(60),
                            
                        Forms\Components\TextInput::make('district')
                            ->label('Bairro')
                            ->maxLength(30),
                            
                        Forms\Components\TextInput::make('city')
                            ->label('Cidade')
                            ->maxLength(80),
                            
                        Forms\Components\TextInput::make('state')
                            ->label('Estado')
                            ->maxLength(2),
                    ])
                    ->columns(3)
                    ->columnSpan('full')
                    ->label('Dados moradia'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            Tables\Columns\TextColumn::make('name')
                ->searchable(),
            Tables\Columns\TextColumn::make('cpf'),
            Tables\Columns\TextColumn::make('companions_count')
                ->label('Acompanhantes')
                ->counts('companions')
                ->badge(),
        ])
        ->actions([
            Tables\Actions\EditAction::make(),
            
            // Botão de ação agrupada para acompanhantes
            Tables\Actions\ActionGroup::make([
                // Ver acompanhantes
                Tables\Actions\Action::make('viewCompanions')
                    ->label('Ver Acompanhantes')
                    ->icon('heroicon-o-user-group')
                    ->url(function (Patient $record) {
                        return CompanionResource::getUrl('index', [
                            'tableFilters[patient][value]' => $record->id,
                        ]);
                    }),
                
                // Adicionar novo acompanhante
                Tables\Actions\Action::make('addCompanion')
                    ->label('Adicionar Acompanhante')
                    ->icon('heroicon-o-plus')
                    ->url(function (Patient $record) {
                        return CompanionResource::getUrl('create', [
                            'patient_id' => $record->id, // Envia como patient_id
                            'patient' => $record->id,    // Mantém como patient para compatibilidade
                        ]);
                    }),
            ])
            ->label('Acompanhantes')
            ->icon('heroicon-o-user-group')
            ->color('primary'),
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
            RelationManagers\CompanionsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPatients::route('/'),
            'create' => Pages\CreatePatient::route('/create'),
            'edit' => Pages\EditPatient::route('/{record}/edit'),
        ];
    }
}
